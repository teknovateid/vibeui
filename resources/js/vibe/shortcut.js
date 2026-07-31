document.addEventListener("DOMContentLoaded", function () {
    /**
     * Konfigurasi untuk shortcut keyboard.
     * Setiap objek shortcut harus memiliki:
     * - keys: Array string yang berisi nama tombol kombinasi (mis., ["Control", "Shift", "k"], ["Enter"], ["Alt", "/"]).
     * Nama tombol bersifat case-insensitive (akan diubah ke lowercase).
     * Untuk tombol modifier, gunakan "Control", "Alt", "Shift", "Meta".
     * Harus ada tepat satu tombol non-modifier sebagai pemicu utama (event.key),
     * kecuali jika shortcutnya adalah satu tombol modifier tunggal (mis., ["Control"]).
     * - action: Fungsi callback yang akan dijalankan ketika shortcut cocok. Menerima objek event sebagai argumen.
     * - preventDefault: (Opsional) Boolean, jika true (default), event.preventDefault() akan dipanggil.
     * - name: (Opsional) Nama deskriptif untuk shortcut (berguna untuk debugging).
     */

    let isShortcutDialogOpen = false;
    const shortcuts = [
        {
            name: "Change Theme",
            keys: ["Control", "D"],
            action: function (event) {
                if (window.VibeTheme) {
                    window.VibeTheme.toggle();
                } else {
                    console.log("Change Theme triggered (VibeTheme not loaded)");
                }
            },
            preventDefault: true,
        },
        {
            name: "Focus Search",
            keys: ["Control", "/"],
            action: function (event) {
                window.dispatchEvent(new CustomEvent("open-search-modal"));
            },
            preventDefault: true,
        },
        {
            name: "Clear Chart",
            keys: ["Control", "Delete"],
            action: function (event) {
                Livewire.dispatch("clear-chart");
            },
            preventDefault: true,
            triggerInInputs: true,
        },
        {
            name: "Help Action",
            keys: ["Control", "h"],
            action: function (event) {
                const dialogId = "shortcut-dialog";
                if (document.getElementById(dialogId) === null) {
                    console.warn("Shortcuts dialog not found.");
                    return;
                }
                if (isShortcutDialogOpen) {
                    Alpine.store("dialog").close(dialogId);
                    isShortcutDialogOpen = false;
                } else {
                    Alpine.store("dialog").open(dialogId);
                    isShortcutDialogOpen = true;
                }
            },
            preventDefault: true,
        },
        {
            name: "Undo Action",
            keys: ["Control", "p"],
            action: function (event) {
                console.log("Aksi Ctrl+P: Undo action triggered");

                const button = document.querySelector("#print-button");

                if (!button) {
                    toast({
                        type: "error",
                        message: "Print not available on this page.",
                    });
                }

                // get button data-url attribute
                const url = button.dataset.url;
                if (!url) {
                    toast({
                        type: "error",
                        message: "Print URL not found.",
                    });
                    return;
                }

                const iframe = document.createElement("iframe");
                iframe.style.display = "none";
                iframe.src = url;

                document.body.appendChild(iframe);
                iframe.onload = function () {
                    try {
                        iframe.contentWindow.print();
                    } catch (e) {
                        window.open(url, "_blank").print();
                    } finally {
                        setTimeout(() => {
                            document.body.removeChild(iframe);
                        }, 1000);
                    }
                };
            },
            preventDefault: true,
        },
        {
            name: "Redo Action",
            keys: ["Control", "y"],
            action: function (event) {
                console.log("Aksi Ctrl+Y: Redo action triggered");
                // Tambahkan logika redo Anda di sini
            },
            preventDefault: true,
        },
        // --- Contoh Kombinasi Dinamis ---
        {
            name: "Satu Tombol: Huruf 's'",
            keys: ["s"], // cocok untuk 's' atau 'S'
            action: function (event) {
                console.log("Aksi satu tombol: 's' ditekan");
            },
            preventDefault: false, // Biasanya false untuk input teks
        },
        {
            name: "Dua Tombol: Alt + k",
            keys: ["Alt", "k"],
            action: function (event) {
                console.log("Aksi dua tombol: Alt + k ditekan");
            },
            preventDefault: true,
        },
        {
            name: "Tiga Tombol: Control + Shift + m",
            keys: ["Control", "Shift", "m"],
            action: function (event) {
                console.log("Aksi tiga tombol: Control + Shift + m ditekan");
            },
            preventDefault: true,
        },
        {
            name: "Tiga Tombol: Alt + Control + ArrowDown",
            keys: ["Alt", "Control", "ArrowDown"], // event.key akan menjadi "ArrowDown"
            action: function (event) {
                console.log(
                    "Aksi tiga tombol: Alt + Control + ArrowDown ditekan"
                );
            },
            preventDefault: true,
        },
    ];

    document.addEventListener("keydown", function (event) {
        if (!event.key) {
            return;
        }
        const activeElement = event.target;
        const isInputFocused =
            activeElement &&
            (activeElement.tagName === "INPUT" ||
                activeElement.tagName === "TEXTAREA" ||
                activeElement.tagName === "SELECT" ||
                activeElement.isContentEditable);

        const pressedKey = event.key.toLowerCase();
        const pressedModifiers = {
            ctrl: event.ctrlKey,
            alt: event.altKey,
            shift: event.shiftKey,
            meta: event.metaKey,
        };

        for (const shortcut of shortcuts) {
            if (!Array.isArray(shortcut.keys)) continue;
            // Logika untuk mencocokkan shortcut (tetap sama)
            const scKeys = shortcut.keys.map((k) => k.toLowerCase());
            const s_ctrl = scKeys.includes("control");
            const s_alt = scKeys.includes("alt");
            const s_shift = scKeys.includes("shift");
            const s_meta = scKeys.includes("meta");

            let s_triggerKeyInDefinition;
            const nonModifierKeysInShortcut = scKeys.filter(
                (k) => !["control", "alt", "shift", "meta"].includes(k)
            );

            if (nonModifierKeysInShortcut.length === 1) {
                s_triggerKeyInDefinition = nonModifierKeysInShortcut[0];
            } else if (
                nonModifierKeysInShortcut.length === 0 &&
                scKeys.length > 0 && // Memastikan array tidak kosong
                nonModifierKeysInShortcut.length === scKeys.length
            ) {
                // Kasus untuk tombol tunggal non-modifier seperti "s"
                s_triggerKeyInDefinition = scKeys[0];
            } else if (
                nonModifierKeysInShortcut.length === 0 &&
                scKeys.length === 1
            ) {
                // Kasus untuk tombol modifier tunggal seperti "Control"
                s_triggerKeyInDefinition = scKeys[0];
            } else if (nonModifierKeysInShortcut.length > 1) {
                // Skip jika ada lebih dari satu tombol non-modifier
                continue;
            }

            const isMatch =
                pressedKey === s_triggerKeyInDefinition &&
                pressedModifiers.ctrl === s_ctrl &&
                pressedModifiers.alt === s_alt &&
                pressedModifiers.shift === s_shift &&
                pressedModifiers.meta === s_meta;

            if (isMatch) {
                // 2. Cek sebelum menjalankan aksi
                // Jika kita berada di dalam input DAN shortcut ini tidak diizinkan di dalam input
                if (isInputFocused && shortcut.triggerInInputs !== true) {
                    // Abaikan shortcut ini dan lanjutkan ke shortcut berikutnya
                    continue;
                }

                // Jika lolos dari pengecekan, jalankan aksi
                if (shortcut.preventDefault !== false) {
                    event.preventDefault();
                }
                shortcut.action(event);

                // Hentikan loop setelah menemukan shortcut yang cocok dan dieksekusi
                break;
            }
        }
    });
});