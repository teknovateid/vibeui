import hljs from 'highlight.js/lib/core';
import javascript from 'highlight.js/lib/languages/javascript';
import typescript from 'highlight.js/lib/languages/typescript';
import xml from 'highlight.js/lib/languages/xml'; // HTML, XML, SVG
import css from 'highlight.js/lib/languages/css';
import php from 'highlight.js/lib/languages/php';
import bash from 'highlight.js/lib/languages/bash';
import json from 'highlight.js/lib/languages/json';
import yaml from 'highlight.js/lib/languages/yaml';
import markdown from 'highlight.js/lib/languages/markdown';
import sql from 'highlight.js/lib/languages/sql';
import diff from 'highlight.js/lib/languages/diff';
import ini from 'highlight.js/lib/languages/ini'; // .env config
import plaintext from 'highlight.js/lib/languages/plaintext';
import '../../css/vibe/highlightjs.css';

// Register standard web development languages
hljs.registerLanguage('javascript', javascript);
hljs.registerLanguage('js', javascript);
hljs.registerLanguage('typescript', typescript);
hljs.registerLanguage('ts', typescript);
hljs.registerLanguage('xml', xml);
hljs.registerLanguage('html', xml);
hljs.registerLanguage('svg', xml);
hljs.registerLanguage('css', css);
hljs.registerLanguage('php', php);
hljs.registerLanguage('bash', bash);
hljs.registerLanguage('sh', bash);
hljs.registerLanguage('shell', bash);
hljs.registerLanguage('zsh', bash);
hljs.registerLanguage('json', json);
hljs.registerLanguage('yaml', yaml);
hljs.registerLanguage('yml', yaml);
hljs.registerLanguage('markdown', markdown);
hljs.registerLanguage('md', markdown);
hljs.registerLanguage('sql', sql);
hljs.registerLanguage('diff', diff);
hljs.registerLanguage('ini', ini);
hljs.registerLanguage('env', ini);
hljs.registerLanguage('plaintext', plaintext);
hljs.registerLanguage('text', plaintext);
hljs.registerLanguage('txt', plaintext);
hljs.registerLanguage('none', plaintext);

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
    if (typeof requestAnimationFrame !== 'undefined') {
        requestAnimationFrame(() => {
            document.querySelectorAll('code[data-vibe-highlight]:not([data-highlighted="yes"])').forEach((el) => {
                highlightElement(el);
            });
        });
    } else {
        document.querySelectorAll('code[data-vibe-highlight]:not([data-highlighted="yes"])').forEach((el) => {
            highlightElement(el);
        });
    }
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
