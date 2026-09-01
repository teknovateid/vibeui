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

function decodeHtmlEntities(str) {
    if (!str) return '';
    return str
        .replace(/&lt;/g, '<')
        .replace(/&gt;/g, '>')
        .replace(/&quot;/g, '"')
        .replace(/&#039;/g, "'")
        .replace(/&amp;/g, '&');
}

export function cleanAndUnindent(raw) {
    if (!raw) return '';
    // Normalize custom vibe tags
    raw = raw.replace(/<x-vibe::([a-zA-Z0-9\-\.]+)/g, '<vibe:$1')
             .replace(/<\/x-vibe::([a-zA-Z0-9\-\.]+)/g, '</vibe:$1');
    
    // Normalize line endings
    raw = raw.replace(/\r\n|\r/g, '\n');
    
    // Trim initial and trailing empty/whitespace-only lines
    raw = raw.replace(/^(\s*\n)+/, '').replace(/(\n\s*)+$/, '');
    
    const lines = raw.split('\n');
    if (lines.length <= 1) return raw.trim();

    let allMinIndent = null;
    for (const line of lines) {
        if (!line.trim()) continue;
        const indent = line.match(/^(\s*)/)[1].length;
        if (allMinIndent === null || indent < allMinIndent) allMinIndent = indent;
    }

    if (allMinIndent !== null && allMinIndent > 0) {
        return lines.map(l => l.replace(new RegExp('^\\s{' + allMinIndent + '}'), '')).join('\n');
    }

    // If first line was trimmed by Blade/Blaze to 0 indent, check common indent of remaining lines
    if (allMinIndent === 0 && lines.length > 1) {
        let subMinIndent = null;
        for (let i = 1; i < lines.length; i++) {
            const line = lines[i];
            if (!line.trim()) continue;
            const indent = line.match(/^(\s*)/)[1].length;
            if (subMinIndent === null || indent < subMinIndent) subMinIndent = indent;
        }
        if (subMinIndent !== null && subMinIndent > 0) {
            for (let i = 1; i < lines.length; i++) {
                lines[i] = lines[i].replace(new RegExp('^\\s{' + subMinIndent + '}'), '');
            }
            return lines.join('\n');
        }
    }

    return raw;
}

export function highlightElement(el) {
    if (!el || el.dataset.highlighted === 'yes') return;
    try {
        // Extract raw code
        let rawContent = el.dataset.rawCode || el.innerHTML;
        let rawCode = cleanAndUnindent(decodeHtmlEntities(rawContent));
        
        // Save clean raw code for copy button
        el.dataset.rawCode = rawCode;
        
        // Detect language from class e.g. language-blade
        let lang = null;
        const langMatch = el.className.match(/\blanguage-([a-zA-Z0-9_-]+)\b/);
        if (langMatch) {
            lang = langMatch[1].toLowerCase();
        }
        
        // Compute and update line numbers in gutter
        const totalLines = rawCode ? rawCode.split('\n').length : 1;
        const card = el.closest('.group\\/highlight') || el.closest('[data-vibe-preview-code]') || el.parentElement?.parentElement;
        if (card) {
            const gutter = card.querySelector('[data-vibe-gutter]');
            if (gutter) {
                let gutterHtml = '';
                for (let i = 1; i <= totalLines; i++) {
                    gutterHtml += `<div>${i}</div>`;
                }
                gutter.innerHTML = gutterHtml;
            }
        }
        
        // Highlight with highlight.js
        let highlighted = '';
        if (lang && hljs.getLanguage(lang)) {
            highlighted = hljs.highlight(rawCode, { language: lang }).value;
        } else {
            highlighted = hljs.highlightAuto(rawCode).value;
        }
        
        el.innerHTML = highlighted;
        el.dataset.highlighted = 'yes';
    } catch (e) {
        console.warn('[VibeHighlight] Highlight error:', e);
    }
}

export function highlightAll() {
    const run = () => {
        document.querySelectorAll('code[data-vibe-highlight]:not([data-highlighted="yes"])').forEach((el) => {
            highlightElement(el);
        });
    };
    if (typeof requestAnimationFrame !== 'undefined') {
        requestAnimationFrame(run);
    } else {
        run();
    }
}

window.VibeHighlight = {
    highlightElement,
    highlightAll,
    cleanAndUnindent,
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
