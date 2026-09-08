
<div
    class="px-3.5 py-3 bg-muted/20 space-y-3 min-w-64"
    :class="{ 'border-t border-border/70': mode !== 'time' && mode !== 'time-range' }"
>
    {{-- Dual Time for datetime-range & time-range --}}
    <template x-if="mode === 'datetime-range' || mode === 'time-range'">
        <div class="space-y-2.5">
            {{-- Start Time --}}
            <div class="flex items-center justify-between gap-3 text-xs">
                <span class="font-semibold text-foreground/80" x-text="dict.timeLabels.startTime"></span>
                <div class="flex items-center gap-1">
                    <input
                        type="number"
                        :min="time24 ? 0 : 1"
                        :max="time24 ? 23 : 12"
                        :value="String(time.hours).padStart(2, '0')"
                        @change="updateTime('start', 'hours', $event.target.value)"
                        @invalid.prevent
                        tabindex="-1"
                        class="w-10 h-7 text-center font-mono font-semibold rounded-md border border-input bg-background text-xs focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                    />
                    <span class="font-bold text-muted-foreground">:</span>
                    <input
                        type="number"
                        min="0"
                        max="59"
                        :step="minuteStep"
                        :value="String(time.minutes).padStart(2, '0')"
                        @change="updateTime('start', 'minutes', $event.target.value)"
                        @invalid.prevent
                        tabindex="-1"
                        class="w-10 h-7 text-center font-mono font-semibold rounded-md border border-input bg-background text-xs focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                    />
                    <template x-if="!time24">
                        <button
                            type="button"
                            @click="updateTime('start', 'period', time.period === 'AM' ? 'PM' : 'AM')"
                            class="px-1.5 h-7 text-[11px] font-bold rounded-md border border-input bg-background hover:bg-accent text-foreground cursor-pointer"
                            x-text="time.period"
                        ></button>
                    </template>
                </div>
            </div>

            {{-- End Time --}}
            <div class="flex items-center justify-between gap-3 text-xs">
                <span class="font-semibold text-foreground/80" x-text="dict.timeLabels.endTime"></span>
                <div class="flex items-center gap-1">
                    <input
                        type="number"
                        :min="time24 ? 0 : 1"
                        :max="time24 ? 23 : 12"
                        :value="String(endTime.hours).padStart(2, '0')"
                        @change="updateTime('end', 'hours', $event.target.value)"
                        @invalid.prevent
                        tabindex="-1"
                        class="w-10 h-7 text-center font-mono font-semibold rounded-md border border-input bg-background text-xs focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                    />
                    <span class="font-bold text-muted-foreground">:</span>
                    <input
                        type="number"
                        min="0"
                        max="59"
                        :step="minuteStep"
                        :value="String(endTime.minutes).padStart(2, '0')"
                        @change="updateTime('end', 'minutes', $event.target.value)"
                        @invalid.prevent
                        tabindex="-1"
                        class="w-10 h-7 text-center font-mono font-semibold rounded-md border border-input bg-background text-xs focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                    />
                    <template x-if="!time24">
                        <button
                            type="button"
                            @click="updateTime('end', 'period', endTime.period === 'AM' ? 'PM' : 'AM')"
                            class="px-1.5 h-7 text-[11px] font-bold rounded-md border border-input bg-background hover:bg-accent text-foreground cursor-pointer"
                            x-text="endTime.period"
                        ></button>
                    </template>
                </div>
            </div>
        </div>
    </template>

    {{-- Single Time (datetime or time) --}}
    <template x-if="mode === 'datetime' || mode === 'time'">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5">
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-foreground flex items-center gap-1.5">
                    <svg class="size-3.5 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <span x-text="dict.timeLabels.time"></span>
                </span>
            </div>

            <div class="flex items-center gap-1.5">
                {{-- Hours Input --}}
                <div class="relative">
                    <input
                        type="number"
                        :min="time24 ? 0 : 1"
                        :max="time24 ? 23 : 12"
                        :value="String(time.hours).padStart(2, '0')"
                        @change="updateTime('start', 'hours', $event.target.value)"
                        @invalid.prevent
                        tabindex="-1"
                        class="w-11 h-8 text-center font-mono font-semibold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs"
                    />
                </div>

                <span class="font-bold text-muted-foreground text-sm">:</span>

                {{-- Minutes Input --}}
                <div class="relative">
                    <input
                        type="number"
                        min="0"
                        max="59"
                        :step="minuteStep"
                        :value="String(time.minutes).padStart(2, '0')"
                        @change="updateTime('start', 'minutes', $event.target.value)"
                        @invalid.prevent
                        tabindex="-1"
                        class="w-11 h-8 text-center font-mono font-semibold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs"
                    />
                </div>

                {{-- Optional Seconds Input --}}
                <template x-if="showSeconds">
                    <div class="flex items-center gap-1.5">
                        <span class="font-bold text-muted-foreground text-sm">:</span>
                        <input
                            type="number"
                            min="0"
                            max="59"
                            :step="secondStep"
                            :value="String(time.seconds).padStart(2, '0')"
                            @change="updateTime('start', 'seconds', $event.target.value)"
                            @invalid.prevent
                            tabindex="-1"
                            class="w-11 h-8 text-center font-mono font-semibold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs"
                        />
                    </div>
                </template>

                {{-- AM / PM Toggle --}}
                <template x-if="!time24">
                    <button
                        type="button"
                        @click="updateTime('start', 'period', time.period === 'AM' ? 'PM' : 'AM')"
                        class="px-2 h-8 text-xs font-bold rounded-lg border border-input bg-background hover:bg-accent text-foreground shadow-2xs cursor-pointer transition-colors"
                        x-text="time.period"
                    ></button>
                </template>

                {{-- "Now" Button --}}
                <button
                    type="button"
                    @click="setTimeNow('start')"
                    class="px-2 h-8 text-[11px] font-medium rounded-lg border border-border bg-accent/50 hover:bg-accent text-foreground transition-colors cursor-pointer ml-1"
                    x-text="dict.timeLabels.now"
                ></button>
            </div>
        </div>
    </template>
</div>
