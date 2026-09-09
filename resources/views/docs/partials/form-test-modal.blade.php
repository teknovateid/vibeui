{{-- Modal Hasil Testing $request->all() untuk Dokumentasi Komponen --}}
@php
    $modalId = $id ?? 'form-test-submission-modal';
@endphp

<div
    x-data="{
        submittedData: {{ json_encode(session('submitted_data', null)) }},
        submittedAt: '{{ session('submitted_at', '') }}',
        activeTab: 'json',
        init() {
            window.addEventListener('vibe-form-submitted', (e) => {
                const detail = e.detail || {};
                const resData = detail.data || {};
                if (resData.submitted_data) {
                    this.submittedData = resData.submitted_data;
                    this.submittedAt = resData.submitted_at || new Date().toLocaleTimeString();
                } else if (resData) {
                    this.submittedData = resData;
                    this.submittedAt = new Date().toLocaleTimeString();
                }
                window.dispatchEvent(new CustomEvent('open-modal', { detail: '{{ $modalId }}' }));
            });
        }
    }"
    @open-modal.window="if ($event.detail === 'form-submission-modal' && '{{ $modalId }}' !== 'form-submission-modal') $dispatch('open-modal', '{{ $modalId }}')"
>
    {{-- Floating Pill Trigger (Muncul saat sudah pernah ada pengiriman form) --}}
    <div
        x-show="submittedData && Object.keys(submittedData).length > 0"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="fixed bottom-6 right-6 z-40"
    >
        <button
            type="button"
            @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: '{{ $modalId }}' }))"
            class="flex items-center gap-2.5 px-3.5 py-2 rounded-full bg-primary text-primary-foreground font-semibold text-xs shadow-xl hover:bg-primary/90 transition-all cursor-pointer border border-primary-foreground/20 hover:scale-105 active:scale-95"
        >
            <span class="flex size-2 rounded-full bg-success animate-pulse"></span>
            <span>Lihat Payload Controller</span>
            <span class="px-1.5 py-0.5 rounded-full bg-primary-foreground/20 text-[10px] font-mono font-bold" x-text="`${Object.keys(submittedData || {}).length} keys`"></span>
        </button>
    </div>

    {{-- Modal Hasil Testing --}}
    <vibe:modal :id="$modalId" :show="session()->has('submitted_data')" maxWidth="2xl">
        {{-- Header Modal --}}
        <vibe:modal.header>
            <div class="flex items-start gap-3">
                <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-success/15 text-success">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                </span>
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span>Form Berhasil Diposting (Controller Test)</span>
                        <vibe:badge variant="success" size="sm">200 OK • AJAX</vibe:badge>
                    </div>
                    <p class="text-sm font-normal text-muted-foreground">
                        Data formulir berhasil diterima oleh <code class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground font-semibold">FormController::store()</code> via <code class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground font-semibold">$request->all()</code> tanpa refresh halaman.
                    </p>
                </div>
            </div>
        </vibe:modal.header>

        <vibe:modal.content>
            <template x-if="!submittedData || Object.keys(submittedData).length === 0">
                <div class="py-8 text-center space-y-2 rounded-xl border border-dashed border-border bg-muted/20">
                    <p class="text-sm font-semibold text-foreground">Belum ada data formulir yang dikirim.</p>
                    <p class="text-xs text-muted-foreground max-w-sm mx-auto">
                        Silakan isi formulir pengujian pada halaman dokumentasi dan klik tombol submit untuk melihat data <code class="font-mono text-xs">$request->all()</code> secara real-time.
                    </p>
                </div>
            </template>

            <template x-if="submittedData && Object.keys(submittedData).length > 0">
                <div class="space-y-5">
                    {{-- Tab Switcher --}}
                    <div class="flex items-center gap-1 border-b border-border pb-1">
                        <button
                            type="button"
                            @click="activeTab = 'json'"
                            class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors cursor-pointer"
                            :class="activeTab === 'json' ? 'bg-primary text-primary-foreground shadow-2xs' : 'text-muted-foreground hover:text-foreground hover:bg-muted/50'"
                        >
                            JSON Payload
                        </button>
                        <button
                            type="button"
                            @click="activeTab = 'table'"
                            class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors cursor-pointer"
                            :class="activeTab === 'table' ? 'bg-primary text-primary-foreground shadow-2xs' : 'text-muted-foreground hover:text-foreground hover:bg-muted/50'"
                        >
                            Tabel Key-Value
                        </button>
                    </div>

                    {{-- Tab 1: JSON Viewer --}}
                    <div x-show="activeTab === 'json'" class="relative rounded-xl border border-border bg-background p-4 text-xs font-mono text-foreground overflow-x-auto shadow-inner max-h-72">
                        <pre><code x-text="JSON.stringify(submittedData, null, 2)"></code></pre>
                    </div>

                    {{-- Tab 2: Table Viewer --}}
                    <div x-show="activeTab === 'table'" class="rounded-xl border border-border overflow-hidden text-xs">
                        <table class="w-full text-left">
                            <thead class="bg-muted/50 border-b border-border text-muted-foreground font-semibold">
                                <tr>
                                    <th class="px-3 py-2">Field (Key)</th>
                                    <th class="px-3 py-2">Nilai (Value)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border">
                                <template x-for="(val, key) in (submittedData || {})" :key="key">
                                    <tr class="hover:bg-muted/20 transition-colors">
                                        <td class="px-3 py-2 font-mono font-semibold text-foreground whitespace-nowrap" x-text="key"></td>
                                        <td class="px-3 py-2 font-mono text-muted-foreground break-all">
                                            <span x-show="key === '_token'" class="text-muted-foreground/60 italic">(CSRF Token Valid)</span>
                                            <span x-show="key !== '_token'" x-text="typeof val === 'object' ? JSON.stringify(val) : (val === '' ? 'null / kosong' : val)"></span>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </template>
        </vibe:modal.content>

        {{-- Footer Modal --}}
        <vibe:modal.footer class="justify-between">
            <p class="text-[11px] text-muted-foreground">
                Waktu respons: <span class="font-mono text-foreground font-medium" x-text="submittedAt || '{{ session('submitted_at', '') }}'"></span>
            </p>
            <vibe:button type="button" variant="primary" size="sm" @click="close">
                Tutup Modal
            </vibe:button>
        </vibe:modal.footer>
    </vibe:modal>
</div>
