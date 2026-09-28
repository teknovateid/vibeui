{{-- Modal Hasil Testing $request->all() untuk Dokumentasi Komponen FilePond --}}
@php
    $modalId = $id ?? 'filepond-test-submission-modal';
@endphp

<div x-data="{
    submittedData: {{ json_encode(session('submitted_data', null)) }},
    submittedAt: '{{ session('submitted_at', '') }}',
    activeTab: 'summary',
    copied: false,
    init() {
        window.addEventListener('vibe-form-submitted', (e) => {
            const detail = e.detail || {};
            const resData = detail.data || {};
            if (resData.request) {
                this.submittedData = resData.request;
                this.submittedAt = resData.timestamp ? new Date(resData.timestamp).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) : new Date().toLocaleTimeString();
            } else if (resData.submitted_data) {
                this.submittedData = resData.submitted_data;
                this.submittedAt = resData.submitted_at || new Date().toLocaleTimeString();
            } else if (resData) {
                this.submittedData = resData;
                this.submittedAt = new Date().toLocaleTimeString();
            }
            window.dispatchEvent(new CustomEvent('open-modal', { detail: '{{ $modalId }}' }));
        });
    },
    copyJson() {
        if (!this.submittedData) return;
        navigator.clipboard.writeText(JSON.stringify(this.submittedData, null, 2));
        this.copied = true;
        setTimeout(() => this.copied = false, 2000);
    },
    copyText(txt) {
        if (!txt) return;
        navigator.clipboard.writeText(txt);
    },
    getFileFields() {
        if (!this.submittedData) return [];
        const list = [];
        for (const [key, val] of Object.entries(this.submittedData)) {
            if (key === '_token') continue;
            const isS3 = typeof val === 'string' && (val.includes('public/presigned/') || val.includes('s3') || val.includes('storage'));
            const isUploadedFile = typeof val === 'object' && val !== null && val.type === 'UploadedFile (Multipart)';
            const isMultiple = Array.isArray(val);

            let strVal = '';
            if (typeof val === 'string') {
                strVal = val;
            } else if (isUploadedFile) {
                strVal = `${val.original_name} (${val.size}, ${val.mime_type})`;
            } else if (Array.isArray(val)) {
                strVal = val.map(v => typeof v === 'object' && v !== null && v.original_name ? `${v.original_name} (${v.size})` : (typeof v === 'string' ? v : JSON.stringify(v))).join(', ');
            } else {
                strVal = JSON.stringify(val);
            }

            list.push({
                key,
                value: strVal,
                isS3,
                isMultiple,
                raw: val,
                type: isS3 ? 'Cloud S3 Key' : (isUploadedFile ? 'Multipart UploadedFile' : (isMultiple ? 'Multiple Files Array' : 'Field Value'))
            });
        }
        return list;
    }
}" @open-modal.window="if ($event.detail === 'filepond-submission-modal' && '{{ $modalId }}' !== 'filepond-submission-modal') $dispatch('open-modal', '{{ $modalId }}')">
    {{-- Floating Pill Trigger (Muncul saat sudah pernah ada pengiriman form) --}}
    <div x-show="submittedData && Object.keys(submittedData).length > 0"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
         class="fixed bottom-6 right-6 z-40">
        <button type="button"
                @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: '{{ $modalId }}' }))"
                class="flex items-center gap-2.5 px-4 py-2.5 rounded-full bg-primary text-primary-foreground font-semibold text-xs shadow-xl hover:bg-primary/90 transition-all cursor-pointer border border-primary-foreground/20 hover:scale-105 active:scale-95">
            <span class="flex size-2 rounded-full bg-success animate-pulse"></span>
            <span>{{ __('docs/test_modal.filepond_pill') }}</span>
            <span class="px-1.5 py-0.5 rounded-full bg-primary-foreground/20 text-[10px] font-mono font-bold" x-text="`${Object.keys(submittedData || {}).length} keys`"></span>
        </button>
    </div>

    {{-- Modal Hasil Testing --}}
    <vibe:modal :id="$modalId" :show="session()->has('submitted_data')" maxWidth="2xl">
        {{-- Header Modal --}}
        <vibe:modal.header>
            <div class="flex items-start gap-3">
                <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-primary/15 text-primary">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8.667 11.243A4.5 4.5 0 0 0 6.286 10.53C3.919 10.53 2 12.426 2 14.765C2 17.104 3.919 19 6.286 19M14.38 8.027A6.4 6.4 0 0 1 16.286 7.7c.655 0 1.284.108 1.87.308M7.116 10.609A6.7 6.7 0 0 1 6.762 8.647C6.762 5.528 9.32 3 12.476 3c2.94 0 5.361 2.194 5.68 5.015a6.5 6.5 0 0 1 3.844 5.338c0 2.707-1.927 4.97-4.5 5.519" />
                        <path d="M12 16v6m-2-4 2-2 2 2" />
                    </svg>
                </span>
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-foreground">{{ __('docs/test_modal.filepond_success_title') }}</span>
                        <vibe:badge variant="primary" size="sm">200 OK • FilepondController</vibe:badge>
                    </div>
                    <p class="text-sm font-normal text-muted-foreground">
                        {!! __('docs/test_modal.filepond_success_desc') !!}
                    </p>
                </div>
            </div>
        </vibe:modal.header>

        <vibe:modal.content>
            <template x-if="!submittedData || Object.keys(submittedData).length === 0">
                <div class="py-8 text-center space-y-2 rounded-xl border border-dashed border-border bg-muted/20">
                    <p class="text-sm font-semibold text-foreground">{{ __('docs/test_modal.empty_title') }}</p>
                    <p class="text-xs text-muted-foreground max-w-sm mx-auto">
                        {!! __('docs/test_modal.filepond_empty_desc') !!}
                    </p>
                </div>
            </template>

            <template x-if="submittedData && Object.keys(submittedData).length > 0">
                <div class="space-y-4">
                    {{-- Tab Switcher --}}
                    <div class="flex items-center justify-between border-b border-border pb-2">
                        <div class="flex items-center gap-1">
                            <button type="button" @click="activeTab = 'summary'"
                                    class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors cursor-pointer"
                                    :class="activeTab === 'summary' ? 'bg-primary text-primary-foreground shadow-2xs' : 'text-muted-foreground hover:text-foreground hover:bg-muted/50'">
                                {{ __('docs/test_modal.tabs.summary') }}
                            </button>
                            <button type="button" @click="activeTab = 'json'"
                                    class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors cursor-pointer"
                                    :class="activeTab === 'json' ? 'bg-primary text-primary-foreground shadow-2xs' : 'text-muted-foreground hover:text-foreground hover:bg-muted/50'">
                                {{ __('docs/test_modal.tabs.json') }}
                            </button>
                            <button type="button" @click="activeTab = 'table'"
                                    class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors cursor-pointer"
                                    :class="activeTab === 'table' ? 'bg-primary text-primary-foreground shadow-2xs' : 'text-muted-foreground hover:text-foreground hover:bg-muted/50'">
                                {{ __('docs/test_modal.tabs.table') }}
                            </button>
                        </div>

                        <button x-show="activeTab === 'json'"
                                type="button"
                                @click="copyJson()"
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[11px] font-medium rounded-md bg-muted text-muted-foreground hover:text-foreground transition-all cursor-pointer">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 11c0-2.828 0-4.243.879-5.121C7.757 5 9.172 5 12 5h3c2.828 0 4.243 0 5.121.879C21 6.757 21 8.172 21 11v5c0 2.828 0 4.243-.879 5.121C19.243 22 17.828 22 15 22h-3c-2.828 0-4.243 0-5.121-.879C6 20.243 6 18.828 6 16v-5Z" />
                                <path d="M6 19c-1.657 0-3-1.343-3-3V10c0-3.771 0-5.657 1.172-6.828C5.343 2 7.229 2 11 2h4c1.657 0 3 1.343 3 3" />
                            </svg>
                            <span x-text="copied ? '{{ __('docs/test_modal.copied') }}' : '{{ __('docs/test_modal.copy_json') }}'"></span>
                        </button>
                    </div>

                    {{-- Tab 1: File Summary Cards --}}
                    <div x-show="activeTab === 'summary'" class="space-y-3">
                        <div class="p-3 rounded-xl bg-primary/10 border border-primary/20 text-primary text-xs flex items-start gap-2.5">
                            <svg class="size-4 shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 8v.01M12 11v5" />
                            </svg>
                            <div class="space-y-0.5">
                                <p class="font-semibold text-foreground">{{ __('docs/test_modal.filepond_flow_success_title') }}</p>
                                <p class="text-muted-foreground text-[11px] leading-relaxed">
                                    {!! __('docs/test_modal.filepond_flow_success_desc') !!}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <template x-for="item in getFileFields()" :key="item.key">
                                <div class="p-3 rounded-xl border border-border bg-card/60 space-y-2">
                                    <div class="flex items-center justify-between text-xs">
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono font-bold text-foreground" x-text="item.key"></span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold"
                                                  :class="item.isS3 ? 'bg-success/15 text-success border border-success/30' : 'bg-muted text-muted-foreground border border-border'"
                                                  x-text="item.type"></span>
                                        </div>
                                        <button type="button"
                                                @click="copyText(item.value)"
                                                class="text-[11px] text-muted-foreground hover:text-primary transition-colors cursor-pointer flex items-center gap-1">
                                            <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 11c0-2.828 0-4.243.879-5.121C7.757 5 9.172 5 12 5h3c2.828 0 4.243 0 5.121.879C21 6.757 21 8.172 21 11v5c0 2.828 0 4.243-.879 5.121C19.243 22 17.828 22 15 22h-3c-2.828 0-4.243 0-5.121-.879C6 20.243 6 18.828 6 16v-5Z" />
                                                <path d="M6 19c-1.657 0-3-1.343-3-3V10c0-3.771 0-5.657 1.172-6.828C5.343 2 7.229 2 11 2h4c1.657 0 3 1.343 3 3" />
                                            </svg>
                                            {{ __('docs/test_modal.copy') }}
                                        </button>
                                    </div>
                                    <div class="font-mono text-xs p-2 rounded-lg bg-background border border-border text-muted-foreground break-all select-all font-medium" x-text="item.value"></div>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Tab 2: JSON Viewer --}}
                    <div x-show="activeTab === 'json'" class="relative rounded-xl border border-border bg-background p-4 text-xs font-mono text-foreground overflow-x-auto shadow-inner max-h-72">
                        <pre><code x-text="JSON.stringify(submittedData, null, 2)"></code></pre>
                    </div>

                    {{-- Tab 3: Table Viewer --}}
                    <div x-show="activeTab === 'table'" class="overflow-hidden">
                        <vibe:table variant="bordered" dense>
                            <vibe:table.header>
                                <vibe:table.column class="whitespace-nowrap">{{ __('docs/test_modal.table_columns.field') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/test_modal.table_columns.value') }}</vibe:table.column>
                                <vibe:table.column class="whitespace-nowrap">{{ __('docs/test_modal.table_columns.type') }}</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                <template x-for="(val, key) in (submittedData || {})" :key="key">
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono font-semibold text-foreground whitespace-nowrap" x-text="key"></vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground break-all">
                                            <span x-show="key === '_token'" class="text-muted-foreground/60 italic">{{ __('docs/test_modal.csrf_valid') }}</span>
                                            <span x-show="key !== '_token'" x-text="typeof val === 'object' ? JSON.stringify(val) : (val === '' ? '{{ __('docs/test_modal.null_empty') }}' : val)"></span>
                                        </vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-[11px] text-muted-foreground whitespace-nowrap">
                                            <span x-text="Array.isArray(val) ? 'Array (' + val.length + ')' : typeof val"></span>
                                        </vibe:table.cell>
                                    </vibe:table.row>
                                </template>
                            </vibe:table.rows>
                        </vibe:table>
                    </div>
                </div>
            </template>
        </vibe:modal.content>

        {{-- Footer Modal --}}
        <vibe:modal.footer class="justify-between">
            <p class="text-[11px] text-muted-foreground">
                {{ __('docs/test_modal.response_time') }} <span class="font-mono text-foreground font-medium" x-text="submittedAt || '{{ session('submitted_at', '') }}'"></span>
            </p>
            <vibe:button type="button" variant="primary" size="sm" @click="close">
                {{ __('docs/test_modal.close_modal') }}
            </vibe:button>
        </vibe:modal.footer>
    </vibe:modal>
</div>
