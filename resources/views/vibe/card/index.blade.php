@blaze(fold: true)

<div 
{{ $attributes->twMerge(['class' => 'bg-vibe-100 dark:bg-vibe-900 p-6 border border-vibe-200 dark:border-vibe-800 rounded-xl']) }}>
{{ $slot }}
</div>