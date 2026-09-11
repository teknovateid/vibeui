
<div class="w-full sm:w-44 sm:shrink-0 relative">
    <div class="sm:absolute sm:inset-0 w-full h-full max-w-71 sm:max-w-none flex flex-row sm:flex-col gap-1 p-2 sm:p-2.5 sm:border-r border-b sm:border-b-0 border-border/70 overflow-x-auto sm:overflow-y-auto vibe-scrollbar bg-muted/20 select-none">
        <template x-for="preset in availablePresets" :key="preset.key">
            <vibe:button
                type="button"
                variant="ghost"
                size="xs"
                @click="selectPreset(preset.key)"
                class="justify-between text-left whitespace-nowrap px-2.5 py-1.5 h-auto rounded-lg text-xs font-medium shrink-0 transition-colors"
                x-bind:class="{
                    'bg-primary text-primary-foreground font-semibold shadow-2xs hover:bg-primary/90': activePreset === preset.key,
                    'text-muted-foreground hover:text-foreground hover:bg-accent': activePreset !== preset.key
                }"
            >
                <span x-text="preset.label"></span>
            </vibe:button>
        </template>
    </div>
</div>

