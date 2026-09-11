
<div
    class="px-3.5 py-3 bg-muted/20 space-y-3 min-w-64"
    :class="{ 'border-t border-border/70': mode !== 'time' && mode !== 'time-range' }"
>
    {{-- Dual Time for datetime-range & time-range --}}
    <template x-if="mode === 'datetime-range' || mode === 'time-range'">
        <div class="grid grid-cols-1 {{ ($dualMonth || $resolvedMode === 'time-range') ? 'sm:grid-cols-2' : '' }} gap-2.5">
            {{-- Start Time Card --}}
            <div class="flex items-center justify-between gap-2 px-3 py-2 rounded-xl bg-card border border-border/70 shadow-2xs">
                <div class="flex items-center gap-1.5 min-w-0">
                    <svg class="size-3.5 text-muted-foreground shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <span class="text-xs font-semibold text-foreground truncate" x-text="dict.timeLabels.startTime"></span>
                </div>

                <div class="flex items-center gap-1 shrink-0">
                    {{-- Hours --}}
                    <input
                        type="text"
                        inputmode="numeric"
                        x-ref="startHours"
                        :aria-label="dict.timeLabels.hours"
                        :value="String(time.hours).padStart(2, '0')"
                        @focus="onTimeFocus('start', 'hours', $event)"
                        @input="onTimeInput('start', 'hours', $event, $refs.startMinutes)"
                        @blur="onTimeBlur('start', 'hours', $event)"
                        @keydown="onTimeKeydown('start', 'hours', $event, $refs.startMinutes, null)"
                        @wheel.prevent="onTimeWheel('start', 'hours', $event)"
                        class="w-9 h-7.5 text-center font-mono font-bold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs transition-colors"
                    />
                    <span class="font-bold text-muted-foreground text-xs select-none">:</span>
                    {{-- Minutes --}}
                    <input
                        type="text"
                        inputmode="numeric"
                        x-ref="startMinutes"
                        :aria-label="dict.timeLabels.minutes"
                        :value="String(time.minutes).padStart(2, '0')"
                        @focus="onTimeFocus('start', 'minutes', $event)"
                        @input="onTimeInput('start', 'minutes', $event, showSeconds ? $refs.startSeconds : null)"
                        @blur="onTimeBlur('start', 'minutes', $event)"
                        @keydown="onTimeKeydown('start', 'minutes', $event, showSeconds ? $refs.startSeconds : null, $refs.startHours)"
                        @wheel.prevent="onTimeWheel('start', 'minutes', $event)"
                        class="w-9 h-7.5 text-center font-mono font-bold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs transition-colors"
                    />
                    {{-- Seconds (optional) --}}
                    <template x-if="showSeconds">
                        <div class="flex items-center gap-1">
                            <span class="font-bold text-muted-foreground text-xs select-none">:</span>
                            <input
                                type="text"
                                inputmode="numeric"
                                x-ref="startSeconds"
                                :aria-label="dict.timeLabels.seconds"
                                :value="String(time.seconds).padStart(2, '0')"
                                @focus="onTimeFocus('start', 'seconds', $event)"
                                @input="onTimeInput('start', 'seconds', $event, null)"
                                @blur="onTimeBlur('start', 'seconds', $event)"
                                @keydown="onTimeKeydown('start', 'seconds', $event, null, $refs.startMinutes)"
                                @wheel.prevent="onTimeWheel('start', 'seconds', $event)"
                                        class="w-9 h-7.5 text-center font-mono font-bold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs transition-colors"
                            />
                        </div>
                    </template>
                    {{-- AM/PM --}}
                    <template x-if="!time24">
                        <vibe:button
                            type="button"
                            variant="outline"
                            size="xs"
                            @click="updateTime('start', 'period', time.period === 'AM' ? 'PM' : 'AM')"
                            class="px-1.5 h-7.5 text-[11px] font-bold rounded-lg"
                            x-text="time.period"
                        ></vibe:button>
                    </template>
                    {{-- Now Button --}}
                    <vibe:button
                        type="button"
                        variant="ghost"
                        size="icon-xs"
                        @click="setTimeNow('start')"
                        x-bind:title="dict.timeLabels.now"
                        x-bind:aria-label="dict.timeLabels.now"
                        class="size-7.5 rounded-lg text-muted-foreground hover:text-foreground"
                    >
                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </vibe:button>
                </div>
            </div>

            {{-- End Time Card --}}
            <div class="flex items-center justify-between gap-2 px-3 py-2 rounded-xl bg-card border border-border/70 shadow-2xs">
                <div class="flex items-center gap-1.5 min-w-0">
                    <svg class="size-3.5 text-muted-foreground shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <span class="text-xs font-semibold text-foreground truncate" x-text="dict.timeLabels.endTime"></span>
                </div>

                <div class="flex items-center gap-1 shrink-0">
                    {{-- Hours --}}
                    <input
                        type="text"
                        inputmode="numeric"
                        x-ref="endHours"
                        :aria-label="dict.timeLabels.hours"
                        :value="String(endTime.hours).padStart(2, '0')"
                        @focus="onTimeFocus('end', 'hours', $event)"
                        @input="onTimeInput('end', 'hours', $event, $refs.endMinutes)"
                        @blur="onTimeBlur('end', 'hours', $event)"
                        @keydown="onTimeKeydown('end', 'hours', $event, $refs.endMinutes, null)"
                        @wheel.prevent="onTimeWheel('end', 'hours', $event)"
                        class="w-9 h-7.5 text-center font-mono font-bold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs transition-colors"
                    />
                    <span class="font-bold text-muted-foreground text-xs select-none">:</span>
                    {{-- Minutes --}}
                    <input
                        type="text"
                        inputmode="numeric"
                        x-ref="endMinutes"
                        :aria-label="dict.timeLabels.minutes"
                        :value="String(endTime.minutes).padStart(2, '0')"
                        @focus="onTimeFocus('end', 'minutes', $event)"
                        @input="onTimeInput('end', 'minutes', $event, showSeconds ? $refs.endSeconds : null)"
                        @blur="onTimeBlur('end', 'minutes', $event)"
                        @keydown="onTimeKeydown('end', 'minutes', $event, showSeconds ? $refs.endSeconds : null, $refs.endHours)"
                        @wheel.prevent="onTimeWheel('end', 'minutes', $event)"
                        class="w-9 h-7.5 text-center font-mono font-bold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs transition-colors"
                    />
                    {{-- Seconds (optional) --}}
                    <template x-if="showSeconds">
                        <div class="flex items-center gap-1">
                            <span class="font-bold text-muted-foreground text-xs select-none">:</span>
                            <input
                                type="text"
                                inputmode="numeric"
                                x-ref="endSeconds"
                                :aria-label="dict.timeLabels.seconds"
                                :value="String(endTime.seconds).padStart(2, '0')"
                                @focus="onTimeFocus('end', 'seconds', $event)"
                                @input="onTimeInput('end', 'seconds', $event, null)"
                                @blur="onTimeBlur('end', 'seconds', $event)"
                                @keydown="onTimeKeydown('end', 'seconds', $event, null, $refs.endMinutes)"
                                @wheel.prevent="onTimeWheel('end', 'seconds', $event)"
                                        class="w-9 h-7.5 text-center font-mono font-bold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs transition-colors"
                            />
                        </div>
                    </template>
                    {{-- AM/PM --}}
                    <template x-if="!time24">
                        <vibe:button
                            type="button"
                            variant="outline"
                            size="xs"
                            @click="updateTime('end', 'period', endTime.period === 'AM' ? 'PM' : 'AM')"
                            class="px-1.5 h-7.5 text-[11px] font-bold rounded-lg"
                            x-text="endTime.period"
                        ></vibe:button>
                    </template>
                    {{-- Now Button --}}
                    <vibe:button
                        type="button"
                        variant="ghost"
                        size="icon-xs"
                        @click="setTimeNow('end')"
                        x-bind:title="dict.timeLabels.now"
                        x-bind:aria-label="dict.timeLabels.now"
                        class="size-7.5 rounded-lg text-muted-foreground hover:text-foreground"
                    >
                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </vibe:button>
                </div>
            </div>
        </div>
    </template>

    {{-- Single Time (datetime or time) --}}
    <template x-if="mode === 'datetime' || mode === 'time'">
        <div class="flex items-center justify-between gap-3 px-3 py-2 rounded-xl bg-card border border-border/70 shadow-2xs">
            <div class="flex items-center gap-2">
                <svg class="size-3.5 text-muted-foreground shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
                <span class="text-xs font-semibold text-foreground truncate" x-text="dict.timeLabels.time"></span>
            </div>

            <div class="flex items-center gap-1.5 shrink-0">
                {{-- Hours Input --}}
                <input
                    type="text"
                    inputmode="numeric"
                    x-ref="singleHours"
                    :aria-label="dict.timeLabels.hours"
                    :value="String(time.hours).padStart(2, '0')"
                    @focus="onTimeFocus('start', 'hours', $event)"
                    @input="onTimeInput('start', 'hours', $event, $refs.singleMinutes)"
                    @blur="onTimeBlur('start', 'hours', $event)"
                    @keydown="onTimeKeydown('start', 'hours', $event, $refs.singleMinutes, null)"
                    @wheel.prevent="onTimeWheel('start', 'hours', $event)"
                    class="w-10 h-8 text-center font-mono font-bold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs transition-colors"
                />

                <span class="font-bold text-muted-foreground text-xs select-none">:</span>

                {{-- Minutes Input --}}
                <input
                    type="text"
                    inputmode="numeric"
                    x-ref="singleMinutes"
                    :aria-label="dict.timeLabels.minutes"
                    :value="String(time.minutes).padStart(2, '0')"
                    @focus="onTimeFocus('start', 'minutes', $event)"
                    @input="onTimeInput('start', 'minutes', $event, showSeconds ? $refs.singleSeconds : null)"
                    @blur="onTimeBlur('start', 'minutes', $event)"
                    @keydown="onTimeKeydown('start', 'minutes', $event, showSeconds ? $refs.singleSeconds : null, $refs.singleHours)"
                    @wheel.prevent="onTimeWheel('start', 'minutes', $event)"
                    class="w-10 h-8 text-center font-mono font-bold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs transition-colors"
                />

                {{-- Optional Seconds Input --}}
                <template x-if="showSeconds">
                    <div class="flex items-center gap-1">
                        <span class="font-bold text-muted-foreground text-xs select-none">:</span>
                        <input
                            type="text"
                            inputmode="numeric"
                            x-ref="singleSeconds"
                            :aria-label="dict.timeLabels.seconds"
                            :value="String(time.seconds).padStart(2, '0')"
                            @focus="onTimeFocus('start', 'seconds', $event)"
                            @input="onTimeInput('start', 'seconds', $event, null)"
                            @blur="onTimeBlur('start', 'seconds', $event)"
                            @keydown="onTimeKeydown('start', 'seconds', $event, null, $refs.singleMinutes)"
                            @wheel.prevent="onTimeWheel('start', 'seconds', $event)"
                                class="w-10 h-8 text-center font-mono font-bold rounded-lg border border-input bg-background text-xs text-foreground focus-visible:outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/20 shadow-2xs transition-colors"
                        />
                    </div>
                </template>

                {{-- AM / PM Toggle --}}
                <template x-if="!time24">
                    <vibe:button
                        type="button"
                        variant="outline"
                        size="xs"
                        @click="updateTime('start', 'period', time.period === 'AM' ? 'PM' : 'AM')"
                        class="px-2 h-8 text-xs font-bold rounded-lg"
                        x-text="time.period"
                    ></vibe:button>
                </template>

                {{-- "Now" Button --}}
                <vibe:button
                    type="button"
                    variant="outline"
                    size="xs"
                    @click="setTimeNow('start')"
                    class="px-2.5 h-8 text-[11px] font-semibold rounded-lg ml-1"
                    x-text="dict.timeLabels.now"
                ></vibe:button>
            </div>
        </div>
    </template>
</div>
