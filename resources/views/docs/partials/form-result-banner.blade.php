{{-- Banner Hasil Pengujian: tampil setelah form di-submit via AJAX --}}
<div
    x-data="{
        submittedData: {{ json_encode(session('submitted_data', null)) }},
        submittedAt: '{{ session('submitted_at', '') }}',
        errorMsg: '',
        init() {
            window.addEventListener('vibe-form-submitted', (e) => {
                this.errorMsg = '';
                const detail = e.detail || {};
                const resData = detail.data || {};
                if (resData.submitted_data) {
                    this.submittedData = resData.submitted_data;
                    this.submittedAt = resData.submitted_at || new Date().toLocaleTimeString();
                } else if (resData && typeof resData === 'object') {
                    this.submittedData = resData;
                    this.submittedAt = new Date().toLocaleTimeString();
                }
            });
            window.addEventListener('vibe-form-error', (e) => {
                this.submittedData = null;
                this.errorMsg = e.detail?.error || 'Terjadi kesalahan saat submit form.';
                console.error('vibe-form-error caught:', e.detail);
            });
        }
    }"
    x-show="(submittedData && Object.keys(submittedData).length > 0) || errorMsg"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-cloak
    class="mt-4 rounded-xl border px-4 py-3"
    :class="errorMsg ? 'border-destructive/30 bg-destructive/10' : 'border-success/30 bg-success/10'"
>
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
        <div class="flex items-start gap-2.5 min-w-0">
            <span class="mt-0.5 shrink-0 flex size-5 items-center justify-center rounded-full bg-success/20 text-success">
                <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 6 9 17l-5-5"/>
                </svg>
            </span>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-foreground" x-text="errorMsg ? 'Gagal mengirim form' : 'Form berhasil diposting ke FormController!'"></p>
                <p class="text-[11px] text-muted-foreground mt-0.5" x-show="!errorMsg">
                    Waktu: <span class="font-mono" x-text="submittedAt"></span>
                    &bull; <span x-text="Object.keys(submittedData || {}).length"></span> fields diterima via JSON (tanpa refresh)
                </p>
                <p class="text-[11px] text-destructive mt-0.5" x-show="errorMsg" x-text="errorMsg"></p>
            </div>
        </div>
        <button
            x-show="!errorMsg"
            type="button"
            @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'form-test-submission-modal' }))"
            class="shrink-0 inline-flex items-center gap-1.5 rounded-lg border border-border bg-background px-3 py-1.5 text-xs font-medium text-foreground shadow-sm hover:bg-muted transition-colors cursor-pointer"
        >
            <svg class="size-3.5 text-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>
            </svg>
            Lihat $request->all()
        </button>
    </div>
</div>
