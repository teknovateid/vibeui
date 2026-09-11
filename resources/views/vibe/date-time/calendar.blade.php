
<div class="p-3">
    {{-- 1. Days Grid View --}}
    <div x-show="viewMode === 'days'" class="space-y-2">
        <div class="flex flex-col sm:flex-row gap-4">
            {{-- Primary Month --}}
            <div class="{{ $dualMonth ? 'w-65 shrink-0' : 'w-65' }}">
                <template x-if="dualMonth">
                    <div class="text-xs font-semibold text-center pb-2 text-foreground/80" x-text="dict.months[currentMonth] + ' ' + currentYear"></div>
                </template>

                {{-- Weekday Headers --}}
                <div class="grid grid-cols-7 text-center gap-1 mb-1">
                    <template x-for="(dayName, idx) in weekDayNames" :key="idx">
                        <div class="text-[11px] font-semibold text-muted-foreground py-1 select-none" x-text="dayName"></div>
                    </template>
                </div>

                {{-- Days Grid --}}
                <div class="grid grid-cols-7 gap-y-1 text-center">
                    <template x-for="(cell, cIdx) in getMonthDays()" :key="cIdx">
                        <div
                            class="relative p-0.5"
                            :class="{
                                'bg-primary/15': cell.isInRange && !cell.isRangeStart && !cell.isRangeEnd,
                                'rounded-l-lg bg-primary/15': cell.isRangeStart && (rangeEnd || hoverDate),
                                'rounded-r-lg bg-primary/15': cell.isRangeEnd && rangeStart
                            }"
                        >
                            <button
                                type="button"
                                @click="selectDay(cell)"
                                @mouseenter="onDayHover(cell)"
                                :disabled="cell.isDisabled"
                                class="relative size-8 mx-auto flex flex-col items-center justify-center text-xs rounded-lg transition-colors select-none font-medium cursor-pointer"
                                :class="{
                                    'bg-primary text-primary-foreground font-bold shadow-xs hover:bg-primary/90': cell.isSelected || cell.isRangeStart || cell.isRangeEnd,
                                    'text-primary font-semibold hover:bg-primary/20': cell.isInRange && !cell.isSelected && !cell.isRangeStart && !cell.isRangeEnd,
                                    'hover:bg-accent text-foreground': !cell.isSelected && !cell.isInRange && cell.isCurrentMonth && !cell.isDisabled,
                                    'text-muted-foreground/40 hover:bg-accent/50': !cell.isSelected && !cell.isInRange && !cell.isCurrentMonth && !cell.isDisabled,
                                    'ring-1 ring-primary/40 font-semibold': cell.isToday && !cell.isSelected && !cell.isInRange,
                                    'opacity-25 cursor-not-allowed pointer-events-none line-through': cell.isDisabled
                                }"
                            >
                                <span x-text="cell.dayNumber"></span>

                                {{-- Event Marker Dot --}}
                                <template x-if="cell.marker">
                                    <span
                                        class="size-1 rounded-full absolute bottom-1"
                                        :class="{
                                            'bg-primary-foreground': cell.isSelected || cell.isRangeStart || cell.isRangeEnd,
                                            'bg-emerald-500': cell.marker === 'emerald' || cell.marker === 'success',
                                            'bg-amber-500': cell.marker === 'amber' || cell.marker === 'warning',
                                            'bg-rose-500': cell.marker === 'rose' || cell.marker === 'destructive',
                                            'bg-primary': !['emerald', 'success', 'amber', 'warning', 'rose', 'destructive'].includes(cell.marker)
                                        }"
                                    ></span>
                                </template>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Optional Dual Month (Desktop) --}}
            <template x-if="dualMonth">
                <div class="hidden sm:block w-65 shrink-0 border-l border-border/70 pl-4">
                    <div class="text-xs font-semibold text-center pb-2 text-foreground/80" x-text="secondMonthLabel"></div>

                    {{-- Weekday Headers --}}
                    <div class="grid grid-cols-7 text-center gap-1 mb-1">
                        <template x-for="(dayName, idx) in weekDayNames" :key="'dm-head-' + idx">
                            <div class="text-[11px] font-semibold text-muted-foreground py-1 select-none" x-text="dayName"></div>
                        </template>
                    </div>

                    {{-- Second Month Days Grid --}}
                    <div class="grid grid-cols-7 gap-y-1 text-center">
                        <template x-for="(cell, cIdx) in secondMonthDays" :key="'dm-cell-' + cIdx">
                            <div
                                class="relative p-0.5"
                                :class="{
                                    'bg-primary/15': cell.isInRange && !cell.isRangeStart && !cell.isRangeEnd,
                                    'rounded-l-lg bg-primary/15': cell.isRangeStart && (rangeEnd || hoverDate),
                                    'rounded-r-lg bg-primary/15': cell.isRangeEnd && rangeStart
                                }"
                            >
                                <button
                                    type="button"
                                    @click="selectDay(cell)"
                                    @mouseenter="onDayHover(cell)"
                                    :disabled="cell.isDisabled"
                                    class="relative size-8 mx-auto flex flex-col items-center justify-center text-xs rounded-lg transition-colors select-none font-medium cursor-pointer"
                                    :class="{
                                        'bg-primary text-primary-foreground font-bold shadow-xs hover:bg-primary/90': cell.isSelected || cell.isRangeStart || cell.isRangeEnd,
                                        'text-primary font-semibold hover:bg-primary/20': cell.isInRange && !cell.isSelected && !cell.isRangeStart && !cell.isRangeEnd,
                                        'hover:bg-accent text-foreground': !cell.isSelected && !cell.isInRange && cell.isCurrentMonth && !cell.isDisabled,
                                        'text-muted-foreground/40 hover:bg-accent/50': !cell.isSelected && !cell.isInRange && !cell.isCurrentMonth && !cell.isDisabled,
                                        'ring-1 ring-primary/40 font-semibold': cell.isToday && !cell.isSelected && !cell.isInRange,
                                        'opacity-25 cursor-not-allowed pointer-events-none line-through': cell.isDisabled
                                    }"
                                >
                                    <span x-text="cell.dayNumber"></span>
                                    <template x-if="cell.marker">
                                        <span class="size-1 rounded-full absolute bottom-1 bg-primary"></span>
                                    </template>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- 2. Fast-Jump Months Grid View --}}
    <div x-show="viewMode === 'months'" class="grid grid-cols-3 gap-2 py-2">
        <template x-for="(mName, mIdx) in dict.months" :key="'month-' + mIdx">
            <button
                type="button"
                @click="setMonth(mIdx)"
                :disabled="isMonthDisabled(mIdx)"
                class="py-2.5 px-2 text-xs rounded-lg font-medium transition-colors text-center cursor-pointer"
                :class="{
                    'bg-primary text-primary-foreground font-bold shadow-xs': currentMonth === mIdx,
                    'hover:bg-accent text-foreground': currentMonth !== mIdx && !isMonthDisabled(mIdx),
                    'opacity-25 cursor-not-allowed pointer-events-none line-through': isMonthDisabled(mIdx)
                }"
                x-text="mName"
            ></button>
        </template>
    </div>

    {{-- 3. Fast-Jump Years Grid View --}}
    <div x-show="viewMode === 'years'" class="grid grid-cols-3 gap-2 py-2">
        <template x-for="(yNum, yIdx) in yearsList" :key="'year-' + yIdx">
            <button
                type="button"
                @click="setYear(yNum)"
                :disabled="isYearDisabled(yNum)"
                class="py-2.5 px-2 text-xs rounded-lg font-medium transition-colors text-center cursor-pointer font-mono"
                :class="{
                    'bg-primary text-primary-foreground font-bold shadow-xs': currentYear === yNum,
                    'hover:bg-accent text-foreground': currentYear !== yNum && !isYearDisabled(yNum),
                    'opacity-25 cursor-not-allowed pointer-events-none': isYearDisabled(yNum)
                }"
                x-text="yNum"
            ></button>
        </template>
    </div>
</div>
