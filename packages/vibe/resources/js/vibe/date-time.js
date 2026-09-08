/**
 * Vibe UI - Interactive Date & Time Picker Component for Alpine.js
 * Supports single date, datetime, date range, datetime range, time only, multiple dates,
 * fast-jump month/year navigation, quick presets, event markers, and dual form outputs.
 */

export function vibeDateTime(config = {}) {
    return {
        id: config.id || 'vibe-dt-' + Math.random().toString(36).substring(2, 9),
        mode: config.mode || 'single', // 'single', 'datetime', 'range', 'datetime-range', 'time', 'time-range', 'multiple', 'month'
        locale: config.locale || 'id', // 'id', 'en'
        firstDayOfWeek: config.firstDayOfWeek !== undefined ? parseInt(config.firstDayOfWeek, 10) : 1, // 1 = Monday, 0 = Sunday
        time24: config.time24 !== undefined ? Boolean(config.time24) : true,
        minuteStep: parseInt(config.minuteStep || 1, 10),
        secondStep: parseInt(config.secondStep || 1, 10),
        showSeconds: Boolean(config.showSeconds),
        minDate: config.minDate || null,
        maxDate: config.maxDate || null,
        disabledDates: Array.isArray(config.disabledDates) ? config.disabledDates : [],
        disabledDaysOfWeek: Array.isArray(config.disabledDaysOfWeek) ? config.disabledDaysOfWeek.map(Number) : [],
        markers: typeof config.markers === 'object' && config.markers !== null ? config.markers : {},
        inline: Boolean(config.inline),
        clearable: config.clearable !== undefined ? Boolean(config.clearable) : true,
        dualMonth: Boolean(config.dualMonth),
        startName: config.startName || null,
        endName: config.endName || null,
        format: config.format || '',
        displayFormat: config.displayFormat || '',
        presets: config.presets !== undefined ? config.presets : false,
        activePreset: null,

        // UI State
        isOpen: false,
        viewMode: 'days', // 'days', 'months', 'years'
        currentMonth: new Date().getMonth(),
        currentYear: new Date().getFullYear(),
        yearsStart: Math.floor(new Date().getFullYear() / 12) * 12,

        // Selection State
        selectedDate: null,       // Date object or null (single, datetime)
        rangeStart: null,         // Date object or null (range, datetime-range)
        rangeEnd: null,           // Date object or null (range, datetime-range)
        hoverDate: null,          // Date object (range hover preview)
        multipleDates: [],        // Array of Date objects
        
        // Time State (for single datetime or time-only)
        time: {
            hours: 12,
            minutes: 0,
            seconds: 0,
            period: 'AM'
        },
        // Range End Time State (for datetime-range)
        endTime: {
            hours: 12,
            minutes: 0,
            seconds: 0,
            period: 'PM'
        },

        // Text input representation
        inputText: '',
        inputStartText: '',
        inputEndText: '',

        // Localization Dictionary supplied from Laravel lang/id or lang/en/vibe/date-time.php
        dict: (config.i18n && typeof config.i18n === 'object' && Object.keys(config.i18n).length > 0)
            ? config.i18n
            : {
                months: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                days: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                daysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                daysMin: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
                presets: {
                    today: 'Hari Ini',
                    yesterday: 'Kemarin',
                    thisWeek: 'Minggu Ini',
                    lastWeek: 'Minggu Lalu',
                    last7Days: '7 Hari Terakhir',
                    last14Days: '14 Hari Terakhir',
                    last30Days: '30 Hari Terakhir',
                    thisMonth: 'Bulan Ini',
                    lastMonth: 'Bulan Lalu',
                    last3Months: '3 Bulan Terakhir',
                    last6Months: '6 Bulan Terakhir',
                    thisQuarter: 'Kuartal Ini',
                    lastQuarter: 'Kuartal Lalu',
                    thisYear: 'Tahun Ini',
                    lastYear: 'Tahun Lalu',
                    yearToDate: 'Tahun Berjalan (YTD)',
                    tomorrow: 'Besok',
                    next7Days: '7 Hari Mendatang',
                    next14Days: '14 Hari Mendatang',
                    next30Days: '30 Hari Mendatang',
                    nextMonth: 'Bulan Depan',
                    nextYear: 'Tahun Depan',
                },
                daysCountLabel: 'hari',
                dayCountLabel: 'hari',
                rangeDuration: ':count hari',
                timeLabels: {
                    time: 'Waktu',
                    hours: 'Jam',
                    minutes: 'Menit',
                    seconds: 'Detik',
                    startTime: 'Waktu Mulai',
                    endTime: 'Waktu Selesai',
                    now: 'Sekarang'
                },
                clear: 'Bersihkan',
                apply: 'Terapkan',
                selectDate: 'Pilih Tanggal',
                selectTime: 'Pilih Jam',
                selectMonth: 'Pilih Bulan',
                selectYear: 'Pilih Tahun',
                multipleSelected: ':count tanggal terpilih'
            },

        init() {
            if (this.inline) {
                this.isOpen = true;
            }

            // Initialize default time
            const now = new Date();
            this.time.hours = this.time24 ? now.getHours() : ((now.getHours() % 12) || 12);
            this.time.minutes = Math.floor(now.getMinutes() / this.minuteStep) * this.minuteStep;
            this.time.period = now.getHours() >= 12 ? 'PM' : 'AM';

            this.endTime.hours = this.time24 ? Math.min(23, now.getHours() + 1) : (((now.getHours() + 1) % 12) || 12);
            this.endTime.minutes = this.time.minutes;
            this.endTime.period = (now.getHours() + 1) >= 12 ? 'PM' : 'AM';

            // Parse initial value if provided
            this.parseInitialValue(config.value);

            if (this.selectedDate) {
                this.currentMonth = this.selectedDate.getMonth();
                this.currentYear = this.selectedDate.getFullYear();
            } else if (this.rangeStart) {
                this.currentMonth = this.rangeStart.getMonth();
                this.currentYear = this.rangeStart.getFullYear();
            }
            this.yearsStart = Math.floor(this.currentYear / 12) * 12;

            this.updateInputDisplay();

            // Watch for open state changes
            this.$watch('isOpen', (val) => {
                if (val && !this.inline) {
                    this.$nextTick(() => this.adjustPosition());
                }
            });
        },

        parseInitialValue(val) {
            if (!val) return;

            try {
                if (this.mode === 'single' || this.mode === 'datetime') {
                    const parsed = this.parseDateString(val);
                    if (parsed) {
                        this.selectedDate = parsed;
                        if (this.mode === 'datetime') {
                            this.time.hours = this.time24 ? parsed.getHours() : ((parsed.getHours() % 12) || 12);
                            this.time.minutes = parsed.getMinutes();
                            this.time.seconds = parsed.getSeconds();
                            this.time.period = parsed.getHours() >= 12 ? 'PM' : 'AM';
                        }
                    }
                } else if (this.mode === 'range' || this.mode === 'datetime-range') {
                    if (Array.isArray(val) && val.length >= 2) {
                        this.rangeStart = this.parseDateString(val[0]);
                        this.rangeEnd = this.parseDateString(val[1]);
                    } else if (typeof val === 'string' && (val.includes(' to ') || val.includes(' - '))) {
                        const separator = val.includes(' to ') ? ' to ' : ' - ';
                        const parts = val.split(separator);
                        this.rangeStart = this.parseDateString(parts[0].trim());
                        this.rangeEnd = this.parseDateString(parts[1].trim());
                    }
                } else if (this.mode === 'multiple' && Array.isArray(val)) {
                    this.multipleDates = val.map(d => this.parseDateString(d)).filter(Boolean);
                } else if (this.mode === 'time') {
                    this.parseTimeString(val, 'start');
                } else if (this.mode === 'time-range') {
                    if (Array.isArray(val) && val.length >= 2) {
                        this.parseTimeString(val[0], 'start');
                        this.parseTimeString(val[1], 'end');
                    } else if (typeof val === 'string' && (val.includes(' to ') || val.includes(' - ') || val.includes(' — '))) {
                        const separator = val.includes(' to ') ? ' to ' : (val.includes(' — ') ? ' — ' : ' - ');
                        const parts = val.split(separator);
                        this.parseTimeString(parts[0].trim(), 'start');
                        this.parseTimeString(parts[1].trim(), 'end');
                    }
                }
            } catch (e) {
                console.warn('VibeDateTime: Error parsing initial value', e);
            }
        },

        parseDateString(str) {
            if (!str) return null;
            if (str instanceof Date) return isNaN(str.getTime()) ? null : str;
            // Support YYYY-MM-DD or ISO
            const d = new Date(str);
            return isNaN(d.getTime()) ? null : d;
        },

        parseTimeString(str, target = 'start') {
            if (!str || typeof str !== 'string') return;
            const timeObj = target === 'end' ? this.endTime : this.time;
            const parts = str.trim().split(':');
            if (parts.length >= 2) {
                let h = parseInt(parts[0], 10);
                let m = parseInt(parts[1], 10);
                let s = parts[2] ? parseInt(parts[2], 10) : 0;
                let period = 'AM';

                if (str.toLowerCase().includes('pm')) {
                    period = 'PM';
                } else if (str.toLowerCase().includes('am')) {
                    period = 'AM';
                }

                timeObj.hours = isNaN(h) ? 12 : h;
                timeObj.minutes = isNaN(m) ? 0 : m;
                timeObj.seconds = isNaN(s) ? 0 : s;
                timeObj.period = period;
            }
        },

        // --- Navigation ---
        prevMonth() {
            if (this.currentMonth === 0) {
                this.currentMonth = 11;
                this.currentYear--;
            } else {
                this.currentMonth--;
            }
            this.yearsStart = Math.floor(this.currentYear / 12) * 12;
        },

        nextMonth() {
            if (this.currentMonth === 11) {
                this.currentMonth = 0;
                this.currentYear++;
            } else {
                this.currentMonth++;
            }
            this.yearsStart = Math.floor(this.currentYear / 12) * 12;
        },

        prevDecade() {
            this.yearsStart -= 12;
        },

        nextDecade() {
            this.yearsStart += 12;
        },

        setYear(year) {
            this.currentYear = year;
            this.viewMode = 'months';
        },

        setMonth(monthIndex) {
            this.currentMonth = monthIndex;
            this.viewMode = 'days';
        },

        toggleViewMode(mode) {
            if (this.viewMode === mode) {
                this.viewMode = 'days';
            } else {
                this.viewMode = mode;
                if (mode === 'years') {
                    this.yearsStart = Math.floor(this.currentYear / 12) * 12;
                }
            }
        },

        // --- Presets & Range Helpers ---
        get availablePresets() {
            if (!this.presets) return [];

            const defaultKeys = [
                'today', 'yesterday',
                'thisWeek', 'lastWeek',
                'last7Days', 'last14Days', 'last30Days',
                'thisMonth', 'lastMonth', 'last3Months',
                'thisQuarter', 'lastQuarter',
                'thisYear', 'lastYear', 'yearToDate'
            ];

            const keys = Array.isArray(this.presets) ? this.presets : defaultKeys;

            return keys.map(key => {
                return {
                    key: key,
                    label: this.dict?.presets?.[key] || key
                };
            }).filter(p => Boolean(p.label));
        },

        get rangeDaysCount() {
            if (!this.rangeStart || !this.rangeEnd) return 0;
            const s = new Date(this.rangeStart.getFullYear(), this.rangeStart.getMonth(), this.rangeStart.getDate());
            const e = new Date(this.rangeEnd.getFullYear(), this.rangeEnd.getMonth(), this.rangeEnd.getDate());
            const diff = Math.abs(e.getTime() - s.getTime());
            return Math.round(diff / (1000 * 60 * 60 * 24)) + 1;
        },

        // --- Calendar Day Generation ---
        get weekDayNames() {
            const days = [...this.dict.daysShort];
            if (this.firstDayOfWeek === 1) {
                const sunday = days.shift();
                days.push(sunday);
            }
            return days;
        },

        getMonthDays(year = this.currentYear, month = this.currentMonth) {
            const firstDayOfMonth = new Date(year, month, 1);
            const lastDayOfMonth = new Date(year, month + 1, 0);
            const daysInMonth = lastDayOfMonth.getDate();

            let startingDay = firstDayOfMonth.getDay();
            if (this.firstDayOfWeek === 1) {
                startingDay = startingDay === 0 ? 6 : startingDay - 1;
            }

            const days = [];

            // Previous month padding
            const prevMonthLastDay = new Date(year, month, 0).getDate();
            for (let i = startingDay - 1; i >= 0; i--) {
                const date = new Date(year, month - 1, prevMonthLastDay - i);
                days.push({
                    date,
                    dayNumber: date.getDate(),
                    isCurrentMonth: false,
                    isToday: this.isSameDay(date, new Date()),
                    isSelected: this.isDateSelected(date),
                    isInRange: this.isDateInRange(date),
                    isRangeStart: this.isRangeStart(date),
                    isRangeEnd: this.isRangeEnd(date),
                    isDisabled: this.isDateDisabled(date),
                    marker: this.getDateMarker(date)
                });
            }

            // Current month days
            for (let i = 1; i <= daysInMonth; i++) {
                const date = new Date(year, month, i);
                days.push({
                    date,
                    dayNumber: i,
                    isCurrentMonth: true,
                    isToday: this.isSameDay(date, new Date()),
                    isSelected: this.isDateSelected(date),
                    isInRange: this.isDateInRange(date),
                    isRangeStart: this.isRangeStart(date),
                    isRangeEnd: this.isRangeEnd(date),
                    isDisabled: this.isDateDisabled(date),
                    marker: this.getDateMarker(date)
                });
            }

            // Next month padding to fill a 6-row grid (42 cells) or 35 cells
            const totalCells = days.length <= 35 ? 35 : 42;
            const remainingDays = totalCells - days.length;
            for (let i = 1; i <= remainingDays; i++) {
                const date = new Date(year, month + 1, i);
                days.push({
                    date,
                    dayNumber: i,
                    isCurrentMonth: false,
                    isToday: this.isSameDay(date, new Date()),
                    isSelected: this.isDateSelected(date),
                    isInRange: this.isDateInRange(date),
                    isRangeStart: this.isRangeStart(date),
                    isRangeEnd: this.isRangeEnd(date),
                    isDisabled: this.isDateDisabled(date),
                    marker: this.getDateMarker(date)
                });
            }

            return days;
        },

        get secondMonthDays() {
            let m = this.currentMonth + 1;
            let y = this.currentYear;
            if (m > 11) {
                m = 0;
                y++;
            }
            return this.getMonthDays(y, m);
        },

        get secondMonthLabel() {
            let m = this.currentMonth + 1;
            let y = this.currentYear;
            if (m > 11) {
                m = 0;
                y++;
            }
            return this.dict.months[m] + ' ' + y;
        },

        get yearsList() {
            const list = [];
            for (let i = 0; i < 12; i++) {
                list.push(this.yearsStart + i);
            }
            return list;
        },

        // --- Date Selection Handlers ---
        selectDay(dayObj) {
            if (dayObj.isDisabled) return;
            this.activePreset = null;
            const date = dayObj.date;

            if (this.mode === 'single' || this.mode === 'datetime') {
                this.selectedDate = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                if (this.mode === 'datetime') {
                    this.applyTime(this.selectedDate, this.time);
                }
                this.updateInputDisplay();
                this.dispatchChange();
                if (this.mode === 'single' && !this.inline) {
                    this.isOpen = false;
                }
            } else if (this.mode === 'range' || this.mode === 'datetime-range') {
                if (!this.rangeStart || (this.rangeStart && this.rangeEnd)) {
                    // Start new range
                    this.rangeStart = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    if (this.mode === 'datetime-range') {
                        this.applyTime(this.rangeStart, this.time);
                    }
                    this.rangeEnd = null;
                    this.hoverDate = null;
                } else if (this.rangeStart && !this.rangeEnd) {
                    // Complete range
                    let end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    if (this.mode === 'datetime-range') {
                        this.applyTime(end, this.endTime);
                    }

                    if (end < this.rangeStart) {
                        this.rangeEnd = this.rangeStart;
                        this.rangeStart = end;
                    } else {
                        this.rangeEnd = end;
                    }
                    this.hoverDate = null;
                    this.updateInputDisplay();
                    this.dispatchChange();
                    if (this.mode === 'range' && !this.inline) {
                        this.isOpen = false;
                    }
                }
            } else if (this.mode === 'multiple') {
                const existingIdx = this.multipleDates.findIndex(d => this.isSameDay(d, date));
                if (existingIdx > -1) {
                    this.multipleDates.splice(existingIdx, 1);
                } else {
                    this.multipleDates.push(new Date(date.getFullYear(), date.getMonth(), date.getDate()));
                    this.multipleDates.sort((a, b) => a - b);
                }
                this.updateInputDisplay();
                this.dispatchChange();
            } else if (this.mode === 'month') {
                this.selectedDate = new Date(date.getFullYear(), date.getMonth(), 1);
                this.updateInputDisplay();
                this.dispatchChange();
                if (!this.inline) this.isOpen = false;
            }
        },

        onDayHover(dayObj) {
            if (dayObj.isDisabled) return;
            if ((this.mode === 'range' || this.mode === 'datetime-range') && this.rangeStart && !this.rangeEnd) {
                this.hoverDate = dayObj.date;
            }
        },

        // --- Validation & Helper Queries ---
        isSameDay(d1, d2) {
            if (!d1 || !d2) return false;
            return d1.getFullYear() === d2.getFullYear() &&
                   d1.getMonth() === d2.getMonth() &&
                   d1.getDate() === d2.getDate();
        },

        isDateSelected(date) {
            if (this.mode === 'single' || this.mode === 'datetime' || this.mode === 'month') {
                return this.isSameDay(date, this.selectedDate);
            }
            if (this.mode === 'range' || this.mode === 'datetime-range') {
                return this.isSameDay(date, this.rangeStart) || this.isSameDay(date, this.rangeEnd);
            }
            if (this.mode === 'multiple') {
                return this.multipleDates.some(d => this.isSameDay(d, date));
            }
            return false;
        },

        isRangeStart(date) {
            return this.isSameDay(date, this.rangeStart);
        },

        isRangeEnd(date) {
            return this.isSameDay(date, this.rangeEnd) || (!this.rangeEnd && this.isSameDay(date, this.hoverDate));
        },

        isDateInRange(date) {
            if (this.mode !== 'range' && this.mode !== 'datetime-range') return false;
            const start = this.rangeStart;
            const end = this.rangeEnd || this.hoverDate;
            if (!start || !end) return false;

            const min = start < end ? start : end;
            const max = start < end ? end : start;

            const time = new Date(date.getFullYear(), date.getMonth(), date.getDate()).getTime();
            const minTime = new Date(min.getFullYear(), min.getMonth(), min.getDate()).getTime();
            const maxTime = new Date(max.getFullYear(), max.getMonth(), max.getDate()).getTime();

            return time >= minTime && time <= maxTime;
        },

        isDateDisabled(date) {
            const time = new Date(date.getFullYear(), date.getMonth(), date.getDate()).getTime();

            if (this.minDate) {
                const min = new Date(this.minDate);
                const minTime = new Date(min.getFullYear(), min.getMonth(), min.getDate()).getTime();
                if (time < minTime) return true;
            }

            if (this.maxDate) {
                const max = new Date(this.maxDate);
                const maxTime = new Date(max.getFullYear(), max.getMonth(), max.getDate()).getTime();
                if (time > maxTime) return true;
            }

            if (this.disabledDaysOfWeek.length > 0) {
                if (this.disabledDaysOfWeek.includes(date.getDay())) return true;
            }

            if (this.disabledDates.length > 0) {
                const str = this.formatDateISO(date);
                if (this.disabledDates.includes(str)) return true;
            }

            return false;
        },

        getDateMarker(date) {
            const str = this.formatDateISO(date);
            return this.markers[str] || null;
        },

        // --- Presets ---
        selectPreset(presetKey) {
            const today = new Date();
            const now = new Date(today.getFullYear(), today.getMonth(), today.getDate());
            let start = null;
            let end = null;

            if (presetKey === 'today') {
                start = new Date(now);
                end = new Date(now);
            } else if (presetKey === 'yesterday') {
                const y = new Date(now);
                y.setDate(y.getDate() - 1);
                start = new Date(y);
                end = new Date(y);
            } else if (presetKey === 'tomorrow') {
                const tm = new Date(now);
                tm.setDate(tm.getDate() + 1);
                start = new Date(tm);
                end = new Date(tm);
            } else if (presetKey === 'thisWeek') {
                const day = now.getDay();
                const diff = (day - this.firstDayOfWeek + 7) % 7;
                start = new Date(now.getFullYear(), now.getMonth(), now.getDate() - diff);
                end = new Date(start.getFullYear(), start.getMonth(), start.getDate() + 6);
            } else if (presetKey === 'lastWeek') {
                const day = now.getDay();
                const diff = (day - this.firstDayOfWeek + 7) % 7;
                const lastWeekEnd = new Date(now.getFullYear(), now.getMonth(), now.getDate() - diff - 1);
                start = new Date(lastWeekEnd.getFullYear(), lastWeekEnd.getMonth(), lastWeekEnd.getDate() - 6);
                end = lastWeekEnd;
            } else if (presetKey === 'last7Days') {
                start = new Date(now);
                start.setDate(start.getDate() - 6);
                end = new Date(now);
            } else if (presetKey === 'last14Days') {
                start = new Date(now);
                start.setDate(start.getDate() - 13);
                end = new Date(now);
            } else if (presetKey === 'last30Days') {
                start = new Date(now);
                start.setDate(start.getDate() - 29);
                end = new Date(now);
            } else if (presetKey === 'thisMonth') {
                start = new Date(now.getFullYear(), now.getMonth(), 1);
                end = new Date(now.getFullYear(), now.getMonth() + 1, 0);
            } else if (presetKey === 'lastMonth') {
                start = new Date(now.getFullYear(), now.getMonth() - 1, 1);
                end = new Date(now.getFullYear(), now.getMonth(), 0);
            } else if (presetKey === 'last3Months') {
                start = new Date(now.getFullYear(), now.getMonth() - 3, now.getDate());
                end = new Date(now);
            } else if (presetKey === 'last6Months') {
                start = new Date(now.getFullYear(), now.getMonth() - 6, now.getDate());
                end = new Date(now);
            } else if (presetKey === 'thisQuarter') {
                const qMonth = Math.floor(now.getMonth() / 3) * 3;
                start = new Date(now.getFullYear(), qMonth, 1);
                end = new Date(now.getFullYear(), qMonth + 3, 0);
            } else if (presetKey === 'lastQuarter') {
                const qMonth = Math.floor(now.getMonth() / 3) * 3;
                start = new Date(now.getFullYear(), qMonth - 3, 1);
                end = new Date(now.getFullYear(), qMonth, 0);
            } else if (presetKey === 'thisYear') {
                start = new Date(now.getFullYear(), 0, 1);
                end = new Date(now.getFullYear(), 11, 31);
            } else if (presetKey === 'lastYear') {
                start = new Date(now.getFullYear() - 1, 0, 1);
                end = new Date(now.getFullYear() - 1, 11, 31);
            } else if (presetKey === 'yearToDate') {
                start = new Date(now.getFullYear(), 0, 1);
                end = new Date(now);
            } else if (presetKey === 'next7Days') {
                start = new Date(now);
                end = new Date(now);
                end.setDate(end.getDate() + 6);
            } else if (presetKey === 'next14Days') {
                start = new Date(now);
                end = new Date(now);
                end.setDate(end.getDate() + 13);
            } else if (presetKey === 'next30Days') {
                start = new Date(now);
                end = new Date(now);
                end.setDate(end.getDate() + 29);
            } else if (presetKey === 'nextMonth') {
                start = new Date(now.getFullYear(), now.getMonth() + 1, 1);
                end = new Date(now.getFullYear(), now.getMonth() + 2, 0);
            } else if (presetKey === 'nextYear') {
                start = new Date(now.getFullYear() + 1, 0, 1);
                end = new Date(now.getFullYear() + 1, 11, 31);
            }

            if (!start || !end) return;

            // Clamping against minDate / maxDate if set
            if (this.minDate) {
                const minD = new Date(this.minDate);
                const minTime = new Date(minD.getFullYear(), minD.getMonth(), minD.getDate());
                if (start < minTime) start = new Date(minTime);
                if (end < minTime) end = new Date(minTime);
            }
            if (this.maxDate) {
                const maxD = new Date(this.maxDate);
                const maxTime = new Date(maxD.getFullYear(), maxD.getMonth(), maxD.getDate());
                if (start > maxTime) start = new Date(maxTime);
                if (end > maxTime) end = new Date(maxTime);
            }
            if (start > end) {
                start = new Date(end);
            }

            if (this.mode === 'range' || this.mode === 'datetime-range') {
                this.rangeStart = start;
                this.rangeEnd = end;
                if (this.mode === 'datetime-range') {
                    this.applyTime(this.rangeStart, this.time);
                    this.applyTime(this.rangeEnd, this.endTime);
                }
            } else {
                this.selectedDate = start;
                if (this.mode === 'datetime') {
                    this.applyTime(this.selectedDate, this.time);
                }
            }

            this.activePreset = presetKey;

            if (this.rangeStart) {
                this.currentMonth = this.rangeStart.getMonth();
                this.currentYear = this.rangeStart.getFullYear();
            } else if (this.selectedDate) {
                this.currentMonth = this.selectedDate.getMonth();
                this.currentYear = this.selectedDate.getFullYear();
            }
            this.yearsStart = Math.floor(this.currentYear / 12) * 12;
            this.hoverDate = null;

            this.updateInputDisplay();
            this.dispatchChange();
            if (!this.inline && this.mode !== 'datetime-range') {
                this.isOpen = false;
            }
        },

        // --- Time Operations ---
        applyTime(dateObj, timeObj) {
            if (!dateObj) return;
            let hours = timeObj.hours;
            if (!this.time24) {
                if (timeObj.period === 'PM' && hours < 12) hours += 12;
                if (timeObj.period === 'AM' && hours === 12) hours = 0;
            }
            dateObj.setHours(hours);
            dateObj.setMinutes(timeObj.minutes);
            dateObj.setSeconds(this.showSeconds ? timeObj.seconds : 0);
        },

        updateTime(type, field, val) {
            const target = type === 'end' ? this.endTime : this.time;
            let num = parseInt(val, 10);
            if (isNaN(num)) num = 0;

            if (field === 'hours') {
                const max = this.time24 ? 23 : 12;
                const min = this.time24 ? 0 : 1;
                target.hours = Math.max(min, Math.min(max, num));
            } else if (field === 'minutes') {
                target.minutes = Math.max(0, Math.min(59, num));
            } else if (field === 'seconds') {
                target.seconds = Math.max(0, Math.min(59, num));
            } else if (field === 'period') {
                target.period = val === 'PM' ? 'PM' : 'AM';
            }

            if (this.mode === 'datetime' && this.selectedDate) {
                this.applyTime(this.selectedDate, this.time);
            } else if (this.mode === 'datetime-range') {
                if (this.rangeStart) this.applyTime(this.rangeStart, this.time);
                if (this.rangeEnd) this.applyTime(this.rangeEnd, this.endTime);
            }

            this.updateInputDisplay();
            this.dispatchChange();
        },

        setTimeNow(type = 'start') {
            const now = new Date();
            const target = type === 'end' ? this.endTime : this.time;
            target.hours = this.time24 ? now.getHours() : ((now.getHours() % 12) || 12);
            target.minutes = now.getMinutes();
            target.seconds = now.getSeconds();
            target.period = now.getHours() >= 12 ? 'PM' : 'AM';

            if (this.mode === 'datetime' && this.selectedDate) {
                this.applyTime(this.selectedDate, this.time);
            } else if (this.mode === 'datetime-range') {
                if (type === 'start' && this.rangeStart) this.applyTime(this.rangeStart, this.time);
                if (type === 'end' && this.rangeEnd) this.applyTime(this.rangeEnd, this.endTime);
            }
            this.updateInputDisplay();
            this.dispatchChange();
        },

        // --- Formatting & Text Display ---
        formatDateISO(d) {
            if (!d) return '';
            const y = d.getFullYear();
            const m = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${y}-${m}-${day}`;
        },

        formatDateDisplay(d) {
            if (!d) return '';
            const day = d.getDate();
            const monthShort = this.dict.monthsShort[d.getMonth()];
            const year = d.getFullYear();
            return `${day} ${monthShort} ${year}`;
        },

        formatDateTimeDisplay(d) {
            if (!d) return '';
            const dateStr = this.formatDateDisplay(d);
            const timeStr = this.formatTimeDisplay(d);
            return `${dateStr} ${timeStr}`;
        },

        formatTimeDisplay(dOrTime) {
            let h, m, s, p;
            if (dOrTime instanceof Date) {
                h = this.time24 ? dOrTime.getHours() : ((dOrTime.getHours() % 12) || 12);
                m = dOrTime.getMinutes();
                s = dOrTime.getSeconds();
                p = dOrTime.getHours() >= 12 ? 'PM' : 'AM';
            } else {
                h = dOrTime.hours;
                m = dOrTime.minutes;
                s = dOrTime.seconds;
                p = dOrTime.period;
            }

            const hStr = String(h).padStart(2, '0');
            const mStr = String(m).padStart(2, '0');
            const sStr = String(s).padStart(2, '0');

            if (this.time24) {
                return this.showSeconds ? `${hStr}:${mStr}:${sStr}` : `${hStr}:${mStr}`;
            } else {
                return this.showSeconds ? `${hStr}:${mStr}:${sStr} ${p}` : `${hStr}:${mStr} ${p}`;
            }
        },

        updateInputDisplay() {
            if (this.mode === 'single') {
                this.inputText = this.selectedDate ? this.formatDateDisplay(this.selectedDate) : '';
            } else if (this.mode === 'datetime') {
                this.inputText = this.selectedDate ? this.formatDateTimeDisplay(this.selectedDate) : '';
            } else if (this.mode === 'range') {
                if (this.rangeStart && this.rangeEnd) {
                    this.inputText = `${this.formatDateDisplay(this.rangeStart)} — ${this.formatDateDisplay(this.rangeEnd)}`;
                    this.inputStartText = this.formatDateISO(this.rangeStart);
                    this.inputEndText = this.formatDateISO(this.rangeEnd);
                } else if (this.rangeStart) {
                    this.inputText = `${this.formatDateDisplay(this.rangeStart)} — ...`;
                    this.inputStartText = this.formatDateISO(this.rangeStart);
                    this.inputEndText = '';
                } else {
                    this.inputText = '';
                    this.inputStartText = '';
                    this.inputEndText = '';
                }
            } else if (this.mode === 'datetime-range') {
                if (this.rangeStart && this.rangeEnd) {
                    this.inputText = `${this.formatDateTimeDisplay(this.rangeStart)} — ${this.formatDateTimeDisplay(this.rangeEnd)}`;
                    this.inputStartText = this.formatDateISO(this.rangeStart) + ' ' + this.formatTimeDisplay(this.rangeStart);
                    this.inputEndText = this.formatDateISO(this.rangeEnd) + ' ' + this.formatTimeDisplay(this.rangeEnd);
                } else if (this.rangeStart) {
                    this.inputText = `${this.formatDateTimeDisplay(this.rangeStart)} — ...`;
                    this.inputStartText = this.formatDateISO(this.rangeStart) + ' ' + this.formatTimeDisplay(this.rangeStart);
                    this.inputEndText = '';
                } else {
                    this.inputText = '';
                    this.inputStartText = '';
                    this.inputEndText = '';
                }
            } else if (this.mode === 'multiple') {
                if (this.multipleDates.length === 0) {
                    this.inputText = '';
                } else if (this.multipleDates.length === 1) {
                    this.inputText = this.formatDateDisplay(this.multipleDates[0]);
                } else {
                    const pattern = this.dict.multipleSelected || ':count tanggal terpilih';
                    this.inputText = pattern.replace(':count', this.multipleDates.length);
                }
            } else if (this.mode === 'time') {
                this.inputText = this.formatTimeDisplay(this.time);
            } else if (this.mode === 'time-range') {
                const s = this.formatTimeDisplay(this.time);
                const e = this.formatTimeDisplay(this.endTime);
                this.inputText = `${s} — ${e}`;
                this.inputStartText = s;
                this.inputEndText = e;
            } else if (this.mode === 'month') {
                this.inputText = this.selectedDate ? `${this.dict.months[this.selectedDate.getMonth()]} ${this.selectedDate.getFullYear()}` : '';
            }
        },

        // --- Manual Direct Typing Input ---
        onManualInput(event) {
            const raw = event.target.value.trim();
            if (!raw) {
                this.clear();
                return;
            }

            if (this.mode === 'single' || this.mode === 'datetime') {
                const parsed = this.parseDateString(raw);
                if (parsed) {
                    this.selectedDate = parsed;
                    this.currentMonth = parsed.getMonth();
                    this.currentYear = parsed.getFullYear();
                    this.dispatchChange();
                }
            }
        },

        // --- Clear & Reset ---
        clear() {
            this.selectedDate = null;
            this.rangeStart = null;
            this.rangeEnd = null;
            this.hoverDate = null;
            this.multipleDates = [];
            this.inputText = '';
            this.inputStartText = '';
            this.inputEndText = '';
            this.activePreset = null;
            this.dispatchChange();
        },

        // --- Value Output for Forms & Livewire ---
        get formValue() {
            if (this.mode === 'single') {
                return this.selectedDate ? this.formatDateISO(this.selectedDate) : '';
            }
            if (this.mode === 'datetime') {
                return this.selectedDate ? (this.formatDateISO(this.selectedDate) + ' ' + this.formatTimeDisplay(this.selectedDate)) : '';
            }
            if (this.mode === 'range') {
                if (this.rangeStart && this.rangeEnd) {
                    return `${this.formatDateISO(this.rangeStart)} to ${this.formatDateISO(this.rangeEnd)}`;
                }
                return this.rangeStart ? this.formatDateISO(this.rangeStart) : '';
            }
            if (this.mode === 'datetime-range') {
                if (this.rangeStart && this.rangeEnd) {
                    return `${this.formatDateISO(this.rangeStart)} ${this.formatTimeDisplay(this.rangeStart)} to ${this.formatDateISO(this.rangeEnd)} ${this.formatTimeDisplay(this.rangeEnd)}`;
                }
                return '';
            }
            if (this.mode === 'multiple') {
                return this.multipleDates.map(d => this.formatDateISO(d)).join(',');
            }
            if (this.mode === 'time') {
                return this.formatTimeDisplay(this.time);
            }
            if (this.mode === 'time-range') {
                return `${this.formatTimeDisplay(this.time)} to ${this.formatTimeDisplay(this.endTime)}`;
            }
            if (this.mode === 'month') {
                return this.selectedDate ? `${this.selectedDate.getFullYear()}-${String(this.selectedDate.getMonth() + 1).padStart(2, '0')}` : '';
            }
            return '';
        },

        dispatchChange() {
            const detail = {
                id: this.id,
                mode: this.mode,
                value: this.formValue,
                start: this.inputStartText || (this.rangeStart ? this.formatDateISO(this.rangeStart) : null),
                end: this.inputEndText || (this.rangeEnd ? this.formatDateISO(this.rangeEnd) : null),
                selectedDate: this.selectedDate,
                multipleDates: this.multipleDates
            };

            this.$dispatch('input', this.formValue);
            this.$dispatch('change', detail);
            this.$dispatch('vibe-date-time-change', detail);
            window.dispatchEvent(new CustomEvent('vibe-date-time-change', { detail }));
        },

        // --- Popover Smart Positioning ---
        adjustPosition() {
            if (this.inline || !this.$refs.popover) return;
            const popover = this.$refs.popover;
            popover.classList.remove('right-0');
            popover.classList.add('left-0');

            const rect = popover.getBoundingClientRect();
            if (rect.right > window.innerWidth - 16) {
                popover.classList.remove('left-0');
                popover.classList.add('right-0');

                const newRect = popover.getBoundingClientRect();
                if (newRect.left < 16) {
                    popover.classList.remove('right-0');
                    popover.classList.add('left-0');
                }
            }
        }
    };
}

// Auto-register in Alpine when available
function registerVibeDateTime() {
    if (typeof window !== 'undefined' && window.Alpine && typeof window.Alpine.data === 'function') {
        window.Alpine.data('vibeDateTime', vibeDateTime);
    }
}

if (typeof window !== 'undefined') {
    window.vibeDateTime = vibeDateTime;
    registerVibeDateTime();
    document.addEventListener('alpine:init', registerVibeDateTime);
    document.addEventListener('livewire:init', registerVibeDateTime);
    document.addEventListener('livewire:navigated', registerVibeDateTime);
    window.dispatchEvent(new CustomEvent('vibe-date-time-ready'));
}
