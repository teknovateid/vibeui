
<div class="flex flex-row sm:flex-col gap-1 p-2 sm:p-2.5 sm:border-r border-b sm:border-b-0 border-border/70 overflow-x-auto sm:overflow-y-auto sm:max-h-95 vibe-scrollbar bg-muted/20 min-w-36 max-w-48 shrink-0 select-none">
    <template x-for="preset in availablePresets" :key="preset.key">
        <button
            type="button"
            @click="selectPreset(preset.key)"
            class="text-left whitespace-nowrap px-2.5 py-1.5 rounded-lg text-xs font-medium transition-colors cursor-pointer flex items-center justify-between"
            :class="{
                'bg-primary text-primary-foreground font-semibold shadow-2xs': activePreset === preset.key,
                'text-muted-foreground hover:text-foreground hover:bg-accent': activePreset !== preset.key
            }"
        >
            <span x-text="preset.label"></span>
        </button>
    </template>
</div>
