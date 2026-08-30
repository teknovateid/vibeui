import hljs from 'highlight.js';
import '../../css/vibe/highlightjs.css';

// Configure highlight.js to suppress unescaped HTML warnings
hljs.configure({ ignoreUnescapedHTML: true });

// Register Blade language support
hljs.registerLanguage('blade', function(hljs) {
    return {
        name: 'Blade',
        aliases: ['blade.php', 'blade', 'html.blade'],
        case_insensitive: true,
        subLanguage: 'xml',
        contains: [
            hljs.COMMENT(/\{\{--/, /--\}\}/),
            {
                className: 'template-variable',
                begin: /\{\{\{?/,
                end: /\}\}\}?/,
                contains: [
                    {
                        subLanguage: 'php',
                        begin: /\S/,
                        end: /(?=\}\}\}?)/,
                    }
                ]
            },
            {
                className: 'keyword',
                begin: /@\b(if|else|elseif|endif|unless|endunless|isset|endisset|empty|endempty|auth|endauth|guest|endguest|switch|case|break|default|endswitch|for|endfor|foreach|endforeach|forelse|endforelse|while|endwhile|continue|include|includeIf|includeWhen|includeFirst|each|extends|section|endsection|yield|show|parent|stack|push|pushOnce|endpush|endpushOnce|prepend|endprepend|component|endcomponent|slot|endslot|props|aware|wire|livewireStyles|livewireScripts|vibeStyles|vibeScripts|vite|session|csrf|method)\b/,
                starts: {
                    end: /(?=\n|$)/,
                    subLanguage: 'php'
                }
            },
            {
                className: 'keyword',
                begin: /@[a-zA-Z0-9_-]+/
            }
        ]
    };
});

window.hljs = hljs;

export function highlightElement(el) {
    if (!el || el.dataset.highlighted === 'yes') return;
    try {
        hljs.highlightElement(el);
    } catch (e) {
        console.warn('[VibeHighlight] Highlight error:', e);
    }
}

export function highlightAll() {
    document.querySelectorAll('code[data-vibe-highlight]:not([data-highlighted="yes"])').forEach((el) => {
        highlightElement(el);
    });
}

window.VibeHighlight = {
    highlightElement,
    highlightAll,
    highlightAuto(code) {
        return hljs.highlightAuto(code).value;
    },
    highlight(code, language) {
        if (language && hljs.getLanguage(language)) {
            return hljs.highlight(code, { language }).value;
        }
        return hljs.highlightAuto(code).value;
    }
};

// Highlight all blocks immediately
highlightAll();

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', highlightAll);
}
document.addEventListener('livewire:navigated', highlightAll);
window.addEventListener('vibe-highlight-ready', highlightAll);

// Dispatch global ready event
window.dispatchEvent(new CustomEvent('vibe-highlight-ready'));
