<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/filepond.title')" :description="__('docs/filepond.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/filepond.title'), 'url' => '/docs/filepond']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/filepond.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/filepond.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/filepond.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/filepond.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['multiple', 'avatar', 'imageCrop', 'imageResize', 'presignUrl', 'wire:model', 'encode'] as $feature)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $feature }}</vibe:badge>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/filepond.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/filepond.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/filepond.basic_usage.preview_title')">
                    <vibe:preview.code>
                        <\vibe:filepond name="document" />
                    </vibe:preview.code>
                    <div class="w-full max-w-lg">
                        <vibe:filepond name="document" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Tampilan Berkas Terunggah (Uploaded File Card) --}}
            <section id="tampilan-berkas" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Tampilan Berkas Terunggah (Card Preview)</h2>
                    <p class="text-sm text-muted-foreground">
                        Ketika berkas dipilih atau diunggah pengguna, berkas ditampilkan dalam bentuk kartu modern terpisah di bawah dropzone. Kartu dilengkapi ikon berkas terlipat, badge format berwarna (<code class="text-xs font-mono text-primary font-semibold">PDF</code> merah, <code class="text-xs font-mono text-primary font-semibold">DOCX</code> biru, <code class="text-xs font-mono text-primary font-semibold">ZIP</code> ungu, dll.), ukuran berkas, serta tombol hapus melingkar.
                    </p>
                </div>

                <vibe:preview title="Pratinjau Kartu Berkas (my-cv.pdf)">
                    <vibe:preview.code>
                        <\vibe:filepond
                            name="cv_preview"
                            demo
                        />
                    </vibe:preview.code>
                    <div class="w-full max-w-lg">
                        <vibe:filepond
                            name="cv_preview"
                            demo
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Multiple Files & Image Preview --}}
            <section id="multiple-preview" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/filepond.multiple_preview.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/filepond.multiple_preview.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/filepond.multiple_preview.preview_title')">
                    <vibe:preview.code>
                        <\vibe:filepond name="photos" label="{{ __('docs/filepond.multiple_preview.label') }}" description="{{ __('docs/filepond.multiple_preview.description') }}" multiple max-files="5" accepted-file-types="image/*" />
                    </vibe:preview.code>
                    <div class="w-full max-w-lg">
                        <vibe:filepond name="photos" :label="__('docs/filepond.multiple_preview.label')" :description="__('docs/filepond.multiple_preview.description')" multiple max-files="5" accepted-file-types="image/*" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Avatar / Circular Mode --}}
            <section id="avatar-mode" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/filepond.avatar_mode.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/filepond.avatar_mode.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/filepond.avatar_mode.preview_title')">
                    <vibe:preview.code>
                        <\vibe:filepond name="avatar" label="{{ __('docs/filepond.avatar_mode.label') }}" description="{{ __('docs/filepond.avatar_mode.description') }}" avatar accepted-file-types="image/png, image/jpeg" />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm flex flex-col items-center justify-center p-6 rounded-2xl border border-border/80 bg-muted/20 backdrop-blur-xs text-center space-y-3">
                        <vibe:filepond name="avatar" :label="__('docs/filepond.avatar_mode.label')" :description="__('docs/filepond.avatar_mode.description')" avatar accepted-file-types="image/png, image/jpeg" />
                        <div class="flex items-center gap-1.5 text-[11px] text-muted-foreground pt-1">
                            <svg class="size-3.5 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="16" x2="12" y2="12"/>
                                <line x1="12" y1="8" x2="12.01" y2="8"/>
                            </svg>
                            <span>PNG, JPEG maks 2MB · Rasio 1:1</span>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Validation --}}
            <section id="validasi-berkas" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/filepond.validation.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/filepond.validation.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/filepond.validation.preview_title')">
                    <vibe:preview.code>
                        <\vibe:filepond name="attachment" label="{{ __('docs/filepond.validation.label') }}" max-file-size="2MB" accepted-file-types="application/pdf, image/*" info="Maksimal ukuran 2MB per file" />
                    </vibe:preview.code>
                    <div class="w-full max-w-lg">
                        <vibe:filepond name="attachment" :label="__('docs/filepond.validation.label')" max-file-size="2MB" accepted-file-types="application/pdf, image/*" info="Maksimal ukuran 2MB per file" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Kustomisasi Tampilan & Konten --}}
            <section id="kustomisasi-dropzone" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Kustomisasi Tampilan & Konten Dropzone</h2>
                    <p class="text-sm text-muted-foreground">
                        Anda dapat menyesuaikan judul dropzone (<code class="text-xs font-mono text-primary font-semibold">title</code>), teks keterangan format (<code class="text-xs font-mono text-primary font-semibold">subtitle</code> / <code class="text-xs font-mono text-primary font-semibold">hint</code>), label tombol (<code class="text-xs font-mono text-primary font-semibold">browse-label</code>), ikon (<code class="text-xs font-mono text-primary font-semibold">icon</code>), maupun varian tampilan (<code class="text-xs font-mono text-primary font-semibold">variant="compact"</code> atau <code class="text-xs font-mono text-primary font-semibold">:dashed="false"</code>).
                    </p>
                </div>

                <vibe:preview title="Dropzone dengan Judul & Tombol Kustom">
                    <vibe:preview.code>
                        <\vibe:filepond
                            name="resume"
                            label="Unggah Berkas Lamaran"
                            title="Tarik & Letakkan Berkas Lamaran (CV)"
                            subtitle="Format PDF, DOCX, atau RTF hingga maksimal 15MB"
                            browse-label="Pilih CV Saya"
                            accepted-file-types="application/pdf, .doc, .docx"
                            max-file-size="15MB"
                        />
                    </vibe:preview.code>
                    <div class="w-full max-w-xl">
                        <vibe:filepond
                            name="resume"
                            label="Unggah Berkas Lamaran"
                            title="Tarik & Letakkan Berkas Lamaran (CV)"
                            subtitle="Format PDF, DOCX, atau RTF hingga maksimal 15MB"
                            browse-label="Pilih CV Saya"
                            accepted-file-types="application/pdf, .doc, .docx"
                            max-file-size="15MB"
                        />
                    </div>
                </vibe:preview>

                <vibe:preview title="Varian Compact (Tampilan Ringkas Horizontal)">
                    <vibe:preview.code>
                        <\vibe:filepond
                            name="quick_attachment"
                            label="Lampiran Singkat"
                            variant="compact"
                            title="Lampirkan Dokumen Pendukung"
                            subtitle="Semua format dokumen diizinkan (maks. 10MB)"
                            browse-label="Jelajahi"
                        />
                    </vibe:preview.code>
                    <div class="w-full max-w-xl">
                        <vibe:filepond
                            name="quick_attachment"
                            label="Lampiran Singkat"
                            variant="compact"
                            title="Lampirkan Dokumen Pendukung"
                            subtitle="Semua format dokumen diizinkan (maks. 10MB)"
                            browse-label="Jelajahi"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Presigned URL Direct-to-Cloud Upload (S3, Cloudflare R2, MinIO) --}}
            <section id="presigned-url" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/filepond.presigned.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/filepond.presigned.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/filepond.presigned.preview_title')">
                    <vibe:preview.code>
                        {{-- Frontend Blade Component --}}
                        <\vibe:filepond name="cloud_file" label="{{ __('docs/filepond.presigned.label') }}" description="{{ __('docs/filepond.presigned.description') }}" presign-url="{{ route('docs.filepond.presigned') }}" presign-method="PUT" max-file-size="500MB" />
                    </vibe:preview.code>
                    <div class="w-full max-w-xl space-y-4">
                        {{-- Cloud Service Pill Banner --}}
                        <div class="flex items-center justify-between p-3.5 rounded-xl border border-border/80 bg-muted/30 backdrop-blur-xs">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-primary/10 text-primary">
                                    <svg class="size-4.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 0 1 2.5 8.242"/>
                                        <path d="M12 12v9"/>
                                        <path d="m16 16-4-4-4 4"/>
                                    </svg>
                                </div>
                                <div class="space-y-0.5">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-semibold text-foreground">Direct Cloud Upload (Presigned URL)</span>
                                        <vibe:badge variant="success" size="xs" class="rounded-full">
                                            ● S3 / R2 PUT
                                        </vibe:badge>
                                    </div>
                                    <p class="text-[11px] text-muted-foreground">Berkas dikirim langsung ke object storage tanpa membebani memori PHP server.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Standalone Presigned FilePond Instance --}}
                        <vibe:filepond
                            name="cloud_file"
                            :label="__('docs/filepond.presigned.label')"
                            :description="__('docs/filepond.presigned.description')"
                            presign-url="{{ route('docs.filepond.presigned') }}"
                            max-file-size="500MB"
                        />

                        {{-- Real-Time Cloud Upload Monitor Card --}}
                        <vibe:card
                            class="p-3.5 space-y-2.5 text-xs shadow-xs transition-all"
                            x-data="{
                                state: 'idle',
                                fileName: '',
                                fileSize: '',
                                progress: 0,
                                s3Key: '',
                                errorMessage: '',
                                formatBytes(bytes) {
                                    if (!bytes || bytes === 0) return '0 B';
                                    const k = 1024;
                                    const sizes = ['B', 'KB', 'MB', 'GB'];
                                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                                    return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
                                }
                            }"
                            @vibe-filepond-presigned-start.window="
                                state = 'uploading';
                                fileName = $event.detail.name;
                                fileSize = formatBytes($event.detail.size);
                                progress = 0;
                                s3Key = '';
                                errorMessage = '';
                            "
                            @vibe-filepond-presigned-progress.window="
                                state = 'uploading';
                                progress = $event.detail.percentage || 0;
                            "
                            @vibe-filepond-presigned-success.window="
                                state = 'success';
                                progress = 100;
                                s3Key = $event.detail.key;
                            "
                            @vibe-filepond-presigned-error.window="
                                state = 'error';
                                errorMessage = $event.detail.error || 'Gagal mengunggah berkas';
                            "
                            @vibe-filepond-presigned-revert.window="
                                state = 'idle';
                                progress = 0;
                                s3Key = '';
                            "
                        >
                            {{-- State Header --}}
                            <div class="flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2">
                                    <span class="relative flex size-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75"
                                            :class="{
                                                'bg-success': state === 'idle' || state === 'success',
                                                'bg-primary': state === 'uploading',
                                                'bg-destructive': state === 'error'
                                            }"
                                        ></span>
                                        <span class="relative inline-flex rounded-full size-2"
                                            :class="{
                                                'bg-success': state === 'idle' || state === 'success',
                                                'bg-primary': state === 'uploading',
                                                'bg-destructive': state === 'destructive'
                                            }"
                                        ></span>
                                    </span>
                                    <span class="font-semibold text-foreground">Status Sinkronisasi Cloud:</span>
                                </div>

                                <template x-if="state === 'idle'">
                                    <span class="inline-flex items-center gap-1 font-medium text-muted-foreground text-[11px]">
                                        <svg class="size-3.5 text-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 6 9 17l-5-5"/>
                                        </svg>
                                        Siap mengunggah langsung ke storage
                                    </span>
                                </template>

                                <template x-if="state === 'uploading'">
                                    <span class="inline-flex items-center gap-1.5 font-semibold text-primary text-[11px]">
                                        <svg class="size-3.5 animate-spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                                        </svg>
                                        Mengunggah direct PUT... <span class="font-mono" x-text="progress + '%'"></span>
                                    </span>
                                </template>

                                <template x-if="state === 'success'">
                                    <span class="inline-flex items-center gap-1 font-semibold text-success text-[11px]">
                                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Tersimpan di Cloud Bucket
                                    </span>
                                </template>

                                <template x-if="state === 'error'">
                                    <span class="inline-flex items-center gap-1 font-semibold text-destructive text-[11px]" x-text="errorMessage"></span>
                                </template>
                            </div>

                            {{-- Live Progress Bar when uploading --}}
                            <div x-show="state === 'uploading'" x-transition class="space-y-1 pt-1">
                                <div class="w-full bg-muted rounded-full h-2 overflow-hidden p-0.5">
                                    <div class="bg-linear-to-r from-primary to-success h-full rounded-full transition-all duration-150" :style="'width: ' + progress + '%'"></div>
                                </div>
                                <div class="flex justify-between text-[11px] text-muted-foreground font-mono">
                                    <span class="truncate max-w-64" x-text="fileName + (fileSize ? ' (' + fileSize + ')' : '')"></span>
                                    <span x-text="progress + '%'"></span>
                                </div>
                            </div>

                            {{-- S3 Key Result Card when upload succeeds --}}
                            <div x-show="state === 'success'" x-transition class="p-2.5 rounded-lg bg-success/10 border border-success/20 text-success space-y-1.5">
                                <div class="flex items-center justify-between text-[11px] font-medium">
                                    <span>Cloud Object Key (Disimpan di Form):</span>
                                    <vibe:badge variant="success" size="xs">Direct PUT Validated</vibe:badge>
                                </div>
                                <div class="font-mono text-[11px] break-all select-all font-semibold bg-background/50 p-2 rounded border border-success/20" x-text="s3Key"></div>
                            </div>
                        </vibe:card>
                    </div>
                </vibe:preview>

                {{-- Backend Example Alert & Code Block --}}
                <vibe:card class="space-y-3">
                    <div class="flex items-center gap-2">
                        <svg class="size-5 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                        <h3 class="font-semibold text-sm text-foreground">Implementasi di FilepondController@presigned</h3>
                    </div>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Endpoint ini menerima request metadata berkas, lalu menghasilkan URL presigned upload sementara menggunakan driver S3 / Cloudflare R2:
                    </p>

                    <vibe:highlightjs language="php">
                        // App\Http\Controllers\FilepondController.php
                        public function presigned(Request $request)
                        {
                        $request->validate([
                        'filename' => 'nullable|string',
                        'type' => 'nullable|string',
                        'size' => 'nullable|integer',
                        ]);

                        $fileKey = 'uploads/' . now()->format('Y/m') . '/' . Str::uuid() . '-' . $request->input('filename');

                        // Generate S3 / R2 Presigned Temporary Upload URL (valid 15 menit)
                        $url = Storage::disk('s3')->temporaryUploadUrl($fileKey, now()->addMinutes(15));

                        return response()->json([
                        'url' => $url,
                        'key' => $fileKey,
                        'method' => 'PUT',
                        ]);
                        }
                    </vibe:highlightjs>
                </vibe:card>
            </section>

            {{-- 6. Form Submission & Backend Controller --}}
            <section id="form-controller" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Form Submission & Controller (Store)</h2>
                    <p class="text-sm text-muted-foreground">
                        Komponen &lt;vibe:filepond&gt; dapat digunakan di dalam form reguler dan diposting langsung ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FilepondController@store</code>.
                    </p>
                </div>

                <vibe:preview title="Pengujian Form Submit Berkas">
                    <vibe:preview.code>
                        <form action="{{ route('docs.filepond.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <\vibe:filepond name="document_submission" label="Pilih Berkas" description="Berkas akan diunggah dan diproses oleh FilepondController@store" required />
                            <vibe:button type="submit" variant="primary">
                                Unggah & Kirim Form
                            </vibe:button>
                        </form>
                    </vibe:preview.code>
                    <div class="w-full max-w-lg">
                        @if (session('success'))
                            <div class="mb-4 p-3.5 rounded-xl bg-success/10 border border-success/20 text-success text-xs font-medium flex items-center gap-2.5 shadow-xs">
                                <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>{{ session('success') }} ({{ session('submitted_at') }})</span>
                            </div>
                        @endif

                        <form action="{{ route('docs.filepond.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-5 rounded-2xl border border-border/80 bg-card space-y-4 shadow-xs">
                            @csrf
                            <vibe:filepond name="document_submission" label="Pilih Berkas" description="Berkas akan diunggah dan diproses oleh FilepondController@store" required />
                            <div class="flex justify-end pt-1">
                                <vibe:button type="submit" variant="primary">
                                    Unggah & Kirim Form
                                </vibe:button>
                            </div>
                        </form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Livewire Integration --}}
            <section id="integrasi-livewire" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/filepond.livewire.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/filepond.livewire.desc') !!}
                    </p>
                </div>

                <vibe:card class="space-y-4">
                    <vibe:highlightjs language="php">
                        namespace App\Livewire;

                        use Livewire\Component;
                        use Livewire\WithFileUploads;

                        class UploadGallery extends Component
                        {
                        use WithFileUploads;

                        public $photos = [];

                        public function save()
                        {
                        $this->validate([
                        'photos.*' => 'image|max:5120', // 5MB Max
                        ]);

                        foreach ($this->photos as $photo) {
                        $photo->store('gallery', 'public');
                        }

                        $this->reset('photos');
                        session()->flash('message', 'Foto berhasil disimpan.');
                        }

                        public function render()
                        {
                        return view('livewire.upload-gallery');
                        }
                        }
                    </vibe:highlightjs>

                    <vibe:highlightjs language="html">
                        {{-- livewire/upload-gallery.blade.php --}}
                        &lt;form wire:submit="save"&gt;
                        &lt;vibe:filepond
                        wire:model="photos"
                        label="Foto Galeri"
                        multiple
                        max-files="5"
                        accepted-file-types="image/*"
                        /&gt;

                        &lt;vibe:button type="submit" class="mt-4"&gt;Simpan Galeri&lt;/vibe:button&gt;
                        &lt;/form&gt;
                    </vibe:highlightjs>
                </vibe:card>
            </section>

            {{-- 7. Props Reference Table --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Referensi Props</h2>
                    <p class="text-sm text-muted-foreground">Daftar lengkap opsi konfigurasi untuk komponen &lt;vibe:filepond&gt;.</p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">Prop</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">Tipe</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">Default</vibe:table.column>
                        <vibe:table.column>Keterangan</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $filepondProps = [
                                ['name', 'string', 'null', 'Nama field input (otomatis diambil dari `wire:model` jika ada).'],
                                ['title', 'string', 'null', 'Kustomisasi judul dropzone (default: "Choose a file or drag & drop it here").'],
                                ['subtitle', 'string', 'null', 'Kustomisasi keterangan format dan ukuran (otomatis dihitung jika kosong).'],
                                ['browse-label', 'string', 'null', 'Teks tombol pemilih berkas (default: "Browse File").'],
                                ['icon', 'string', '"cloud"', 'Pilihan ikon dropzone (`cloud`, `upload`, `folder`, atau SVG string).'],
                                ['variant', 'string', '"default"', 'Varian layout: `"default"` (lengkap), `"compact"` (horizontal), atau `"avatar"`.'],
                                ['dashed', 'bool', 'true', 'Garis batas putus-putus (`true`) atau garis padat (`false`).'],
                                ['drop-height', 'string', 'null', 'Tinggi minimal kustom dropzone, contoh: `"16rem"`, `"250px"`.'],
                                ['multiple', 'bool', 'false', 'Mengizinkan pemilihan dan pengunggahan banyak berkas sekaligus.'],
                                ['max-files', 'int', 'null', 'Batas maksimal jumlah berkas yang dapat diunggah bersamaan.'],
                                ['max-file-size', 'string', 'null', 'Batas ukuran per berkas, contoh: `"2MB"`, `"500KB"`.'],
                                ['accepted-file-types', 'string | array', 'null', 'Filter format mime berkas, contoh: `"image/*, application/pdf"`.'],
                                ['avatar', 'bool', 'false', 'Mengaktifkan mode lingkaran compact 1:1 untuk foto profil.'],
                                ['image-crop', 'bool', 'false', 'Mengaktifkan fitur pemotongan gambar otomatis/manual.'],
                                ['image-crop-aspect-ratio', 'string', 'null', 'Rasio aspek pemotongan gambar, contoh: `"1:1"`, `"16:9"`.'],
                                ['presign-url', 'string', 'null', 'Endpoint backend untuk mendapatkan URL presigned cloud storage.'],
                                ['presign-method', 'string', '"PUT"', 'HTTP method pengunggahan langsung ke cloud storage.'],
                                ['encode', 'bool', 'false', 'Mengonversi berkas ke base64 string untuk form submission standar.'],
                                ['existing-files', 'array', '[]', 'Daftar URL berkas awal yang sudah ada (misal untuk form edit).'],
                                ['demo', 'bool', 'false', 'Menampilkan contoh berkas simulasi (mock file) secara langsung tanpa perlu upload.'],
                                ['demo-files', 'array', '[]', 'Daftar nama berkas simulasi untuk demonstrasi tampilan kartu berkas.']
                            ];
                        @endphp
                        @foreach ($filepondProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground text-xs">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
