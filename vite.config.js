import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';
import fs from 'fs';
import path from 'path';

function vibeSyncPlugin() {
    const syncRules = [
        {
            srcPattern: '/resources/views/vibe/',
            destDir: 'packages/vibe/resources/views/vibe',
            label: 'Views',
        },
        {
            srcPattern: '/resources/css/vibe/',
            destDir: 'packages/vibe/resources/css/vibe',
            label: 'CSS',
        },
        {
            srcPattern: '/resources/js/vibe/',
            destDir: 'packages/vibe/resources/js/vibe',
            label: 'JS',
        },
        {
            srcPattern: '/public/vibe/',
            destDir: 'packages/vibe/public/vibe',
            label: 'Public',
        },
        {
            srcPattern: '/resources/views/components/docs/layouts/',
            destDir: 'packages/vibe/stubs/Layouts/layouts',
            label: 'Docs Layouts',
            transform: (content) => {
                return content
                    .replace(/<x-docs\.layouts\./g, '<x-layouts.')
                    .replace(/<\/x-docs\.layouts\./g, '</x-layouts.')
                    .replace(/<x-docs\.partials\./g, '<x-partials.')
                    .replace(/<\/x-docs\.partials\./g, '</x-partials.');
            },
        },
        {
            srcPattern: '/lang/en/vibe/',
            destDir: 'packages/vibe/lang/en/vibe',
            label: 'Lang EN',
        },
        {
            srcPattern: '/lang/id/vibe/',
            destDir: 'packages/vibe/lang/id/vibe',
            label: 'Lang ID',
        },
    ];

    return {
        name: 'vibe-sync',
        configureServer(server) {
            server.watcher.on('all', (event, file) => {
                const normalizedFile = file.replace(/\\/g, '/');

                for (const rule of syncRules) {
                    if (normalizedFile.includes(rule.srcPattern)) {
                        const relativePath = normalizedFile.split(rule.srcPattern)[1];
                        const dest = path.resolve(process.cwd(), rule.destDir, relativePath);
                        
                        if (event === 'add' || event === 'change') {
                            const destDir = path.dirname(dest);
                            if (!fs.existsSync(destDir)) {
                                fs.mkdirSync(destDir, { recursive: true });
                            }
                            try {
                                if (rule.transform) {
                                    const content = fs.readFileSync(file, 'utf-8');
                                    const transformed = rule.transform(content);
                                    fs.writeFileSync(dest, transformed, 'utf-8');
                                } else {
                                    fs.copyFileSync(file, dest);
                                }
                                console.log(`\n[Vibe Sync - ${rule.label}] Disinkronkan ke packages: ${relativePath}`);
                            } catch (e) {
                                console.error(`\n[Vibe Sync - ${rule.label}] Gagal mengcopy:`, e);
                            }
                        } else if (event === 'unlink') {
                            try {
                                if (fs.existsSync(dest)) {
                                    fs.unlinkSync(dest);
                                    console.log(`\n[Vibe Sync - ${rule.label}] Dihapus dari packages: ${relativePath}`);
                                }
                            } catch (e) {
                                console.error(`\n[Vibe Sync - ${rule.label}] Gagal menghapus:`, e);
                            }
                        } else if (event === 'unlinkDir') {
                            try {
                                if (fs.existsSync(dest)) {
                                    fs.rmSync(dest, { recursive: true, force: true });
                                    console.log(`\n[Vibe Sync - ${rule.label}] Folder dihapus dari packages: ${relativePath}`);
                                }
                            } catch (e) {
                                console.error(`\n[Vibe Sync - ${rule.label}] Gagal menghapus folder:`, e);
                            }
                        }
                        break;
                    }
                }
            });
        }
    }
}

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/vibe/highlightjs.css',
                'resources/css/vibe/chart.css',
                'resources/css/vibe/filepond.css',
                'resources/js/vibe/chart.js',
                'resources/js/vibe/date-time.js',
                'resources/js/vibe/dynamic-form.js',
                'resources/js/vibe/filepond.js',
                'resources/js/vibe/form.js',
                'resources/js/vibe/grid.js',
                'resources/js/vibe/highlightjs.js',
                'resources/js/vibe/table.js',
            ],
            refresh: true,
            fonts: [
                bunny('Figtree', {
                    weights: [400, 500, 600, 700],
                    display: 'swap',
                    preload: false,
                }),
            ],
        }),
        tailwindcss(),
        vibeSyncPlugin(),
    ],
    build: {
        sourcemap: true,
    },
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
        cors: true,
    },
});
