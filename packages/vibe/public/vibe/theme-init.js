(function () {
    // Vibe UI Theme Initialization (Anti-FOUC)
    var prefix = window.VIBE_PREFIX || 'vibe';
    var k = prefix + '-theme';
    var s = localStorage.getItem(k);
    var d = false;

    if (s) {
        if (s === 'dark') d = true;
        else if (s === 'system') d = window.matchMedia('(prefers-color-scheme: dark)').matches;
        else {
            try {
                var c = JSON.parse(s);
                d = c.mode === 'dark' || (c.mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            } catch (e) { }
        }
    } else {
        d = window.matchMedia('(prefers-color-scheme: dark)').matches;
    }

    if (d) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
})();