import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';
import fs from 'fs';
import path from 'path';

function vibeSyncPlugin() {
    return {
        name: 'vibe-sync',
        configureServer(server) {
            server.watcher.on('all', (event, file) => {
                const normalizedFile = file.replace(/\\/g, '/');
                const vibePath = '/resources/views/vibe/';
                if (normalizedFile.includes(vibePath)) {
                    const relativePath = normalizedFile.split(vibePath)[1];
                    const dest = path.resolve(process.cwd(), 'packages/vibe/resources/views/vibe', relativePath);
                    
                    if (event === 'add' || event === 'change') {
                        const destDir = path.dirname(dest);
                        if (!fs.existsSync(destDir)) {
                            fs.mkdirSync(destDir, { recursive: true });
                        }
                        try {
                            fs.copyFileSync(file, dest);
                            console.log(`\n[Vibe Sync] Disinkronkan ke packages: ${relativePath}`);
                        } catch (e) {
                            console.error(`\n[Vibe Sync] Gagal mengcopy:`, e);
                        }
                    } else if (event === 'unlink') {
                        try {
                            if (fs.existsSync(dest)) {
                                fs.unlinkSync(dest);
                                console.log(`\n[Vibe Sync] Dihapus dari packages: ${relativePath}`);
                            }
                        } catch (e) {
                            console.error(`\n[Vibe Sync] Gagal menghapus:`, e);
                        }
                    } else if (event === 'unlinkDir') {
                        try {
                            if (fs.existsSync(dest)) {
                                fs.rmSync(dest, { recursive: true, force: true });
                                console.log(`\n[Vibe Sync] Folder dihapus dari packages: ${relativePath}`);
                            }
                        } catch (e) {
                            console.error(`\n[Vibe Sync] Gagal menghapus folder:`, e);
                        }
                    }
                }
            });
        }
    }
}

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
        vibeSyncPlugin(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
        cors: true,
    },
});
