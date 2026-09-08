@blaze

@props([
    'code' => null,
    'language' => null,
    'lang' => null,
    'title' => null,
    'filename' => null,
    'icon' => null,
    'theme' => 'vibe',
    'copyable' => true,
    'lineNumbers' => false,
    'lines' => null,
    'wrap' => false,
    'maxHeight' => null,
    'header' => null,
    'badge' => true,
])

@php
    $resolvedLang = strtolower($language ?: ($lang ?: ''));
    $showLines = $lines !== null ? (bool) $lines : (bool) $lineNumbers;
    $rawCode = $code !== null ? (string) $code : (isset($slot) ? (string) $slot : '');
    
    // Normalize compiled <x-vibe:: tags back to custom <vibe: tags for documentation code display
    $rawCode = preg_replace('/<x-vibe::([a-zA-Z0-9\-\.]+)/', '<vibe:$1', $rawCode);
    $rawCode = preg_replace('/<\/x-vibe::([a-zA-Z0-9\-\.]+)/', '</vibe:$1', $rawCode);
    $rawCode = preg_replace('/<(\/)?\\\\(vibe:|x-)/', '<$1$2', $rawCode);

    // Normalize Windows CRLF / CR line endings to standard LF
    $rawCode = str_replace(["\r\n", "\r"], "\n", $rawCode);

    // Trim initial and trailing empty/whitespace-only lines
    $rawCode = preg_replace('/^(\s*\n)+/', '', $rawCode);
    $rawCode = preg_replace('/(\n\s*)+$/', '', $rawCode);
    
    // Auto-unindent multiline code blocks indented in Blade templates
    $codeLines = explode("\n", $rawCode);
    if (count($codeLines) > 1) {
        $allMinIndent = null;
        foreach ($codeLines as $line) {
            if (trim($line) === '') continue;
            preg_match('/^(\s*)/', $line, $m);
            $indent = strlen($m[1] ?? '');
            if ($allMinIndent === null || $indent < $allMinIndent) {
                $allMinIndent = $indent;
            }
        }

        if ($allMinIndent !== null && $allMinIndent > 0) {
            $codeLines = array_map(function($line) use ($allMinIndent) {
                return preg_replace('/^\s{' . $allMinIndent . '}/', '', $line);
            }, $codeLines);
            $rawCode = implode("\n", $codeLines);
        } elseif ($allMinIndent === 0) {
            // If the first line was trimmed by Blade/Blaze to 0 indent, calculate common indent from remaining lines
            $subMinIndent = null;
            for ($i = 1; $i < count($codeLines); $i++) {
                $line = $codeLines[$i];
                if (trim($line) === '') continue;
                preg_match('/^(\s*)/', $line, $m);
                $indent = strlen($m[1] ?? '');
                if ($subMinIndent === null || $indent < $subMinIndent) {
                    $subMinIndent = $indent;
                }
            }
            if ($subMinIndent !== null && $subMinIndent > 0) {
                for ($i = 1; $i < count($codeLines); $i++) {
                    $codeLines[$i] = preg_replace('/^\s{' . $subMinIndent . '}/', '', $codeLines[$i]);
                }
                $rawCode = implode("\n", $codeLines);
            }
        }
    }
    
    $trimmedCode = trim($rawCode);
    
    // Auto-detect bash / terminal commands if language is not explicitly provided
    $isTerminalCommand = preg_match('/^(php\s+artisan|composer|npm|npx|pnpm|yarn|bun|git|docker|curl|wget|sudo|cd|cat|ls|chmod|brew|valet)\b/i', $trimmedCode);
    if (!$resolvedLang && $isTerminalCommand) {
        $resolvedLang = 'bash';
    }
    
    // Auto-upgrade html with blade syntax to blade highlighter
    if (($resolvedLang === 'html' || $resolvedLang === '') && (str_contains($rawCode, '@') || str_contains($rawCode, '{{') || str_contains($rawCode, '<vibe:'))) {
        $resolvedLang = 'blade';
    }
    
    $isBashOrTerminal = in_array($resolvedLang, ['bash', 'sh', 'shell', 'zsh', 'terminal', 'cmd', 'powershell']);
    
    // Resolve Default Title
    if ($title === null && $filename === null) {
        if ($isBashOrTerminal) {
            $resolvedTitle = 'Terminal';
        } else {
            $resolvedTitle = null;
        }
    } else {
        $resolvedTitle = $title !== null ? $title : $filename;
    }
    
    // Resolve Default Badge Text
    if ($badge === false || $badge === 'false' || $badge === 0) {
        $showBadge = false;
        $badgeText = '';
    } else {
        $showBadge = true;
        if (is_string($badge) && $badge !== '1' && $badge !== '') {
            $badgeText = $badge;
        } elseif ($isBashOrTerminal) {
            $badgeText = 'BASH';
        } elseif ($resolvedLang === 'blade') {
            $badgeText = 'BLADE';
        } else {
            $badgeText = strtoupper($resolvedLang);
        }
    }
    
    // Resolve Theme
    $themeClass = 'vibe-theme-' . $theme;
    
    // Resolve Icon
    $resolvedIcon = $icon;
    if (!$resolvedIcon) {
        if ($isBashOrTerminal) {
            $resolvedIcon = 'terminal';
        } else {
            $resolvedIcon = match($resolvedLang) {
                'php' => 'php',
                'js', 'javascript', 'ts', 'typescript' => 'js',
                'css', 'scss', 'sass', 'less' => 'css',
                'html', 'blade' => 'html',
                default => 'file',
            };
        }
    }
    
    $lineCount = count($codeLines);
    $showHeader = $header !== null ? (bool) $header : ($resolvedTitle !== null || ($showBadge && $badgeText) || $copyable);
    
    $maxHeightStyle = $maxHeight ? (is_numeric($maxHeight) ? "max-height: {$maxHeight}px;" : "max-height: {$maxHeight};") : '';
    $wrapClass = $wrap ? 'whitespace-pre-wrap break-words' : 'whitespace-pre overflow-x-auto';
@endphp

@pushOnce('head', 'vibe-highlightjs')
    @vite(['resources/css/vibe/highlightjs.css', 'resources/js/vibe/highlightjs.js'])
@endPushOnce

<div
    x-data="{
        copied: false,
        copyCode() {
            let codeEl = this.$refs.codeBlock;
            let text = codeEl ? (codeEl.dataset.rawCode || codeEl.innerText || codeEl.textContent) : '';
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text.trim()).then(() => {
                    this.copied = true;
                    setTimeout(() => this.copied = false, 2000);
                });
            }
        },
        runHighlight() {
            let el = this.$refs.codeBlock;
            if (el && window.VibeHighlight) {
                window.VibeHighlight.highlightElement(el);
            } else if (el && window.hljs && el.dataset.highlighted !== 'yes') {
                window.hljs.highlightElement(el);
            }
        },
        init() {
            this.$nextTick(() => this.runHighlight());
            if (!window.hljs) {
                window.addEventListener('vibe-highlight-ready', () => {
                    this.$nextTick(() => this.runHighlight());
                }, { once: true });
                let timer = setInterval(() => {
                    if (window.hljs) {
                        clearInterval(timer);
                        this.$nextTick(() => this.runHighlight());
                    }
                }, 50);
                setTimeout(() => clearInterval(timer), 3000);
            }
        }
    }"
    {{ $attributes->twMerge(['class' => "group/highlight relative flex flex-col rounded-xl bg-card text-card-foreground border border-border overflow-hidden shadow-xs {$themeClass}"]) }}
>
    @if ($showHeader)
        <div data-vibe-header class="flex items-center justify-between px-4 py-2.5 bg-muted/60 border-b border-border text-xs text-muted-foreground">
            <div class="flex items-center gap-2 min-w-0">
                @if ($resolvedTitle)
                    <div class="flex items-center gap-1.5 font-mono text-xs font-semibold text-foreground truncate">
                        {{-- Icon Rendering --}}
                        @if (isset($iconSlot))
                            {{ $iconSlot }}
                        @elseif (str_starts_with(trim($resolvedIcon), '<svg'))
                            {!! $resolvedIcon !!}
                        @elseif ($resolvedIcon === 'terminal' || $resolvedIcon === 'bash')
                            <svg class="size-3.5 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="4 17 10 11 4 5"/>
                                <line x1="12" y1="19" x2="20" y2="19"/>
                            </svg>
                        @elseif ($resolvedIcon === 'code')
                            <svg class="size-3.5 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="16 18 22 12 16 6"/>
                                <polyline points="8 6 2 12 8 18"/>
                            </svg>
                        @else
                            <svg class="size-3.5 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                <polyline points="14 2 14 8 20 8"/>
                            </svg>
                        @endif

                        <span class="truncate">{{ $resolvedTitle }}</span>
                    </div>
                @endif

                @if ($showBadge && $badgeText)
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold font-mono uppercase tracking-wider bg-muted text-foreground border border-border">
                        {{ $badgeText }}
                    </span>
                @endif
            </div>

            <div class="flex items-center gap-2 shrink-0 ml-2">
                @if ($copyable)
                    <button
                        type="button"
                        @click="copyCode()"
                        class="inline-flex items-center justify-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium min-w-16 text-muted-foreground hover:text-foreground hover:bg-accent transition-colors focus:outline-none cursor-pointer"
                        aria-label="{{ __('vibe/preview.copy') }}"
                    >
                        <span x-show="!copied" class="inline-flex items-center gap-1.5">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/>
                                <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                            </svg>
                            <span>{{ __('vibe/preview.copy') }}</span>
                        </span>
                        <span x-show="copied" x-cloak class="inline-flex items-center gap-1.5 text-success font-semibold" style="display: none;">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>{{ __('vibe/preview.copied') }}</span>
                        </span>
                    </button>
                @endif
            </div>
        </div>
    @elseif ($copyable)
        {{-- Floating copy button when header is hidden --}}
        <div class="absolute top-2.5 right-2.5 z-10">
            <button
                type="button"
                @click="copyCode()"
                class="inline-flex items-center justify-center size-8 rounded-lg bg-muted/80 backdrop-blur-xs text-xs font-medium text-muted-foreground hover:text-foreground hover:bg-accent transition-all border border-border shadow-xs focus:outline-none cursor-pointer"
                aria-label="{{ __('vibe/preview.copy') }}"
                title="{{ __('vibe/preview.copy') }}"
            >
                <svg x-show="!copied" class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/>
                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                </svg>
                <svg x-show="copied" x-cloak class="size-4 text-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </button>
        </div>
    @endif

    <div class="relative flex min-w-0 overflow-x-auto vibe-scrollbar @if($maxHeight) overflow-y-auto @endif" @if($maxHeightStyle) style="{{ $maxHeightStyle }}" @endif>
        @if ($showLines)
            <div data-vibe-gutter class="select-none text-right py-4 pr-3 pl-3.5 font-mono text-xs sm:text-sm text-muted-foreground/70 border-r border-border shrink-0 leading-relaxed">
                @for ($i = 1; $i <= $lineCount; $i++)
                    <div>{{ $i }}</div>
                @endfor
            </div>
        @endif

        <pre class="flex-1 p-4 font-mono text-xs sm:text-sm leading-relaxed {{ $wrapClass }} focus:outline-none"><code x-ref="codeBlock" data-vibe-highlight class="hljs @if($resolvedLang) language-{{ $resolvedLang }} @endif">{!! htmlspecialchars($rawCode, ENT_QUOTES, 'UTF-8') !!}</code></pre>
    </div>
</div>
