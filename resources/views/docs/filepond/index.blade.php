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
                        <\vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <\vibe:filepond name="document" label="Unggah Dokumen" />
                            <div class="flex justify-end pt-1">
                                <\vibe:button type="submit" variant="primary" size="sm">
                                    Kirim Form (Test Request)
                                </\vibe:button>
                            </div>
                        </\vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-lg">
                        <vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <vibe:filepond name="document" label="Unggah Dokumen" />
                            <div class="flex justify-end pt-1">
                                <vibe:button type="submit" variant="primary" size="sm">
                                    <svg class="size-3.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m22 2-7 20-4-9-9-4Z" />
                                        <path d="M22 2 11 13" />
                                    </svg>
                                    Kirim Form (Test Request)
                                </vibe:button>
                            </div>
                        </vibe:form>
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
                        <\vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <\vibe:filepond name="cv_preview" label="Curriculum Vitae" demo />
                            <div class="flex justify-end pt-1">
                                <\vibe:button type="submit" variant="primary" size="sm">
                                    Kirim Form (Test Request)
                                </\vibe:button>
                            </div>
                        </\vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-lg">
                        <vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <vibe:filepond name="cv_preview" label="Curriculum Vitae" demo />
                            <div class="flex justify-end pt-1">
                                <vibe:button type="submit" variant="primary" size="sm">
                                    <svg class="size-3.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m22 2-7 20-4-9-9-4Z" />
                                        <path d="M22 2 11 13" />
                                    </svg>
                                    Kirim Form (Test Request)
                                </vibe:button>
                            </div>
                        </vibe:form>
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
                        <\vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <\vibe:filepond name="photos" label="{{ __('docs/filepond.multiple_preview.label') }}" description="{{ __('docs/filepond.multiple_preview.description') }}" multiple max-files="5" accepted-file-types="image/*" />
                            <div class="flex justify-end pt-1">
                                <\vibe:button type="submit" variant="primary" size="sm">
                                    Kirim Multiple Foto (Test Request)
                                </\vibe:button>
                            </div>
                        </\vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-lg">
                        <vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <vibe:filepond name="photos" :label="__('docs/filepond.multiple_preview.label')" :description="__('docs/filepond.multiple_preview.description')" multiple max-files="5" accepted-file-types="image/*" />
                            <div class="flex justify-end pt-1">
                                <vibe:button type="submit" variant="primary" size="sm">
                                    <svg class="size-3.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m22 2-7 20-4-9-9-4Z" />
                                        <path d="M22 2 11 13" />
                                    </svg>
                                    Kirim Multiple Foto (Test Request)
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Avatar / Circular Mode --}}
            <section id="avatar-mode" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/filepond.avatar_mode.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/filepond.avatar_mode.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/filepond.avatar_mode.preview_title')">
                    <vibe:preview.code>
                        <\vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-xs mx-auto text-center">
                            <\vibe:filepond name="avatar" label="{{ __('docs/filepond.avatar_mode.label') }}" description="{{ __('docs/filepond.avatar_mode.description') }}" avatar accepted-file-types="image/png, image/jpeg" />
                            <div class="flex justify-center">
                                <\vibe:button type="submit" variant="primary" size="sm">
                                    Simpan Avatar (Test Request)
                                </\vibe:button>
                            </div>
                        </\vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-xs mx-auto">
                        <vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-center">
                            <vibe:filepond name="avatar" :label="__('docs/filepond.avatar_mode.label')" :description="__('docs/filepond.avatar_mode.description')" avatar accepted-file-types="image/png, image/jpeg" />
                            <div class="flex justify-center">
                                <vibe:button type="submit" variant="primary" size="sm">
                                    <svg class="size-3.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m22 2-7 20-4-9-9-4Z" />
                                        <path d="M22 2 11 13" />
                                    </svg>
                                    Simpan Avatar (Test Request)
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Validation --}}
            <section id="validasi-berkas" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/filepond.validation.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/filepond.validation.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/filepond.validation.preview_title')">
                    <vibe:preview.code>
                        <\vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <\vibe:filepond name="attachment" label="{{ __('docs/filepond.validation.label') }}" max-file-size="2MB" accepted-file-types="application/pdf, image/*" info="Maksimal ukuran 2MB per file" />
                            <div class="flex justify-end pt-1">
                                <\vibe:button type="submit" variant="primary" size="sm">
                                    Kirim Lampiran (Test Request)
                                </\vibe:button>
                            </div>
                        </\vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-lg">
                        <vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <vibe:filepond name="attachment" :label="__('docs/filepond.validation.label')" max-file-size="2MB" accepted-file-types="application/pdf, image/*" info="Maksimal ukuran 2MB per file" />
                            <div class="flex justify-end pt-1">
                                <vibe:button type="submit" variant="primary" size="sm">
                                    <svg class="size-3.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m22 2-7 20-4-9-9-4Z" />
                                        <path d="M22 2 11 13" />
                                    </svg>
                                    Kirim Lampiran (Test Request)
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Kustomisasi Tampilan & Konten --}}
            <section id="kustomisasi-dropzone" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Kustomisasi Tampilan & Konten Dropzone</h2>
                    <p class="text-sm text-muted-foreground">
                        Anda dapat menyesuaikan judul dropzone (<code class="text-xs font-mono text-primary font-semibold">title</code>), teks keterangan format (<code class="text-xs font-mono text-primary font-semibold">subtitle</code> / <code class="text-xs font-mono text-primary font-semibold">hint</code>), label tombol (<code class="text-xs font-mono text-primary font-semibold">browse-label</code>), ikon (<code class="text-xs font-mono text-primary font-semibold">icon</code>), maupun varian tampilan (<code class="text-xs font-mono text-primary font-semibold">variant="compact"</code> atau <code class="text-xs font-mono text-primary font-semibold">:dashed="false"</code>).
                    </p>
                </div>

                <vibe:preview title="Dropzone dengan Judul & Tombol Kustom">
                    <vibe:preview.code>
                        <\vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <\vibe:filepond name="resume" label="Unggah Berkas Lamaran" title="Tarik & Letakkan Berkas Lamaran (CV)" subtitle="Format PDF, DOCX, atau RTF hingga maksimal 15MB" browse-label="Pilih CV Saya" accepted-file-types="application/pdf, .doc, .docx" max-file-size="15MB" />
                            <div class="flex justify-end pt-1">
                                <\vibe:button type="submit" variant="primary" size="sm">
                                    Kirim CV (Test Request)
                                </\vibe:button>
                            </div>
                        </\vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl">
                        <vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <vibe:filepond name="resume" label="Unggah Berkas Lamaran" title="Tarik & Letakkan Berkas Lamaran (CV)" subtitle="Format PDF, DOCX, atau RTF hingga maksimal 15MB" browse-label="Pilih CV Saya" accepted-file-types="application/pdf, .doc, .docx" max-file-size="15MB" />
                            <div class="flex justify-end pt-1">
                                <vibe:button type="submit" variant="primary" size="sm">
                                    <svg class="size-3.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m22 2-7 20-4-9-9-4Z" />
                                        <path d="M22 2 11 13" />
                                    </svg>
                                    Kirim CV (Test Request)
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>

                <vibe:preview title="Varian Compact (Tampilan Ringkas Horizontal)">
                    <vibe:preview.code>
                        <\vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <\vibe:filepond name="quick_attachment" label="Lampiran Singkat" variant="compact" title="Lampirkan Dokumen Pendukung" subtitle="Semua format dokumen diizinkan (maks. 10MB)" browse-label="Jelajahi" />
                            <div class="flex justify-end pt-1">
                                <\vibe:button type="submit" variant="primary" size="sm">
                                    Kirim Lampiran (Test Request)
                                </\vibe:button>
                            </div>
                        </\vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl">
                        <vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <vibe:filepond name="quick_attachment" label="Lampiran Singkat" variant="compact" title="Lampirkan Dokumen Pendukung" subtitle="Semua format dokumen diizinkan (maks. 10MB)" browse-label="Jelajahi" />
                            <div class="flex justify-end pt-1">
                                <vibe:button type="submit" variant="primary" size="sm">
                                    <svg class="size-3.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m22 2-7 20-4-9-9-4Z" />
                                        <path d="M22 2 11 13" />
                                    </svg>
                                    Kirim Lampiran (Test Request)
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Kontrol Programatis & Pilihan Ukuran --}}
            @php
                $demoProgrammaticCode = <<<'BLADE'
                <div x-data="{
                    pondRef() {
                        var el = document.getElementById('api-pond-container') || document.getElementById('api-pond')?.closest('[data-vibe-filepond]');
                        return el?._x_dataStack?.find(s => s && (s.pond || s.browse));
                    }
                }" class="space-y-3">
                    <vibe:filepond id="api-pond" name="api_pond" size="sm" label="Dropzone Ukuran Small (size='sm')" demo />
                    <div class="flex items-center gap-2">
                        <vibe:button type="button" size="xs" variant="secondary" @click="pondRef()?.browse()">
                            Buka Pemilih Berkas (browse)
                        </vibe:button>
                        <vibe:button type="button" size="xs" variant="destructive" @click="pondRef()?.clear()">
                            Bersihkan (clear)
                        </vibe:button>
                    </div>
                </div>
                BLADE;
            @endphp
            <section id="kontrol-programatis" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Kontrol Programatis & Ukuran Dropzone</h2>
                    <p class="text-sm text-muted-foreground">
                        FilePond menyediakan opsi ukuran <code class="text-xs font-mono text-primary font-semibold">size="sm" | "md" | "lg"</code> serta metode Alpine seperti <code class="text-xs font-mono text-primary font-semibold">browse()</code> dan <code class="text-xs font-mono text-primary font-semibold">clear()</code>.
                    </p>
                </div>

                <vibe:preview title="Kontrol Programatis Eksternal" :code="$demoProgrammaticCode">
                    <div class="w-full max-w-lg" x-data="{
                        pondRef() {
                            var el = document.getElementById('api-pond-container') || document.getElementById('api-pond')?.closest('[data-vibe-filepond]');
                            return el?._x_dataStack?.find(s => s && (s.pond || s.browse));
                        }
                    }">
                        <vibe:filepond id="api-pond" name="api_pond" size="sm" label="Dropzone Ukuran Small (size='sm')" demo />
                        <div class="flex items-center gap-2 mt-3">
                            <vibe:button type="button" size="xs" variant="secondary" @click="pondRef()?.browse()">
                                <svg class="size-3.5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z" />
                                </svg>
                                Buka Pemilih Berkas (browse)
                            </vibe:button>
                            <vibe:button type="button" size="xs" variant="destructive" @click="pondRef()?.clear()">
                                <svg class="size-3.5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18m-2 0v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                </svg>
                                Bersihkan (clear)
                            </vibe:button>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Presigned URL Direct-to-Cloud Upload (S3, Cloudflare R2, MinIO) --}}
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
                        <\vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" class="space-y-3">
                            <\vibe:filepond name="cloud_file" label="{{ __('docs/filepond.presigned.label') }}" description="{{ __('docs/filepond.presigned.description') }}" presign-url="{{ route('docs.filepond.presigned') }}" presign-method="PUT" max-file-size="500MB" />
                            <div class="flex justify-end pt-1">
                                <\vibe:button type="submit" variant="primary" size="sm">
                                    Kirim Kunci S3 ke Controller
                                </\vibe:button>
                            </div>
                        </\vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl space-y-4">
                        {{-- Cloud Service Pill Banner --}}
                        <div class="flex items-center justify-between p-3.5 rounded-xl border border-border/80 bg-muted/30 backdrop-blur-xs">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-primary/10 text-primary">
                                    <svg class="size-4.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 0 1 2.5 8.242" />
                                        <path d="M12 12v9" />
                                        <path d="m16 16-4-4-4 4" />
                                    </svg>
                                </div>
                                <div class="space-y-0.5">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-semibold text-foreground">Direct Cloud Upload (Presigned URL)</span>
                                        <vibe:badge variant="success" size="xs" class="rounded-full">
                                            S3 / R2 PUT
                                        </vibe:badge>
                                    </div>
                                    <p class="text-[11px] text-muted-foreground">Berkas dikirim langsung ke object storage tanpa membebani memori PHP server.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Standalone Presigned FilePond Form Instance --}}
                        <vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" class="space-y-3">
                            <vibe:filepond name="cloud_file" :label="__('docs/filepond.presigned.label')" :description="__('docs/filepond.presigned.description')" presign-url="{{ route('docs.filepond.presigned') }}" max-file-size="500MB" />
                            <div class="flex justify-end pt-1">
                                <vibe:button type="submit" variant="primary" size="sm">
                                    <svg class="size-3.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m22 2-7 20-4-9-9-4Z" />
                                        <path d="M22 2 11 13" />
                                    </svg>
                                    Kirim Kunci S3 ke Controller (Test Request)
                                </vibe:button>
                            </div>
                        </vibe:form>

                        {{-- Real-Time Cloud Upload Monitor Card --}}
                        {{-- <vibe:card class="p-3.5 space-y-2.5 text-xs shadow-xs transition-all" x-data="{
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
                        }" @vibe-filepond-presigned-start.window="
                                state = 'uploading';
                                fileName = $event.detail.name;
                                fileSize = formatBytes($event.detail.size);
                                progress = 0;
                                s3Key = '';
                                errorMessage = '';
                            " @vibe-filepond-presigned-progress.window="
                                state = 'uploading';
                                progress = $event.detail.percentage || 0;
                            " @vibe-filepond-presigned-success.window="
                                state = 'success';
                                progress = 100;
                                s3Key = $event.detail.key;
                            " @vibe-filepond-presigned-error.window="
                                state = 'error';
                                errorMessage = $event.detail.error || 'Gagal mengunggah berkas';
                            " @vibe-filepond-presigned-revert.window="
                                state = 'idle';
                                progress = 0;
                                s3Key = '';
                            ">
                            <div class="flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2">
                                    <span class="relative flex size-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" :class="{
                                            'bg-success': state === 'idle' || state === 'success',
                                            'bg-primary': state === 'uploading',
                                            'bg-destructive': state === 'error'
                                        }"></span>
                                        <span class="relative inline-flex rounded-full size-2" :class="{
                                            'bg-success': state === 'idle' || state === 'success',
                                            'bg-primary': state === 'uploading',
                                            'bg-destructive': state === 'destructive'
                                        }"></span>
                                    </span>
                                    <span class="font-semibold text-foreground">Status Sinkronisasi Cloud:</span>
                                </div>

                                <template x-if="state === 'idle'">
                                    <span class="inline-flex items-center gap-1 font-medium text-muted-foreground text-[11px]">
                                        <svg class="size-3.5 text-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 6 9 17l-5-5" />
                                        </svg>
                                        Siap mengunggah langsung ke storage
                                    </span>
                                </template>

                                <template x-if="state === 'uploading'">
                                    <span class="inline-flex items-center gap-1.5 font-semibold text-primary text-[11px]">
                                        <svg class="size-3.5 animate-spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                                        </svg>
                                        Mengunggah direct PUT... <span class="font-mono" x-text="progress + '%'"></span>
                                    </span>
                                </template>

                                <template x-if="state === 'success'">
                                    <span class="inline-flex items-center gap-1 font-semibold text-success text-[11px]">
                                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        Tersimpan di Cloud Bucket
                                    </span>
                                </template>

                                <template x-if="state === 'error'">
                                    <span class="inline-flex items-center gap-1 font-semibold text-destructive text-[11px]" x-text="errorMessage"></span>
                                </template>
                            </div>
                            <div x-show="state === 'uploading'" x-transition class="space-y-1 pt-1">
                                <div class="w-full bg-muted rounded-full h-2 overflow-hidden p-0.5">
                                    <div class="bg-linear-to-r from-primary to-success h-full rounded-full transition-all duration-150" :style="'width: ' + progress + '%'"></div>
                                </div>
                                <div class="flex justify-between text-[11px] text-muted-foreground font-mono">
                                    <span class="truncate max-w-64" x-text="fileName + (fileSize ? ' (' + fileSize + ')' : '')"></span>
                                    <span x-text="progress + '%'"></span>
                                </div>
                            </div>
                            <div x-show="state === 'success'" x-transition class="p-2.5 rounded-lg bg-success/10 border border-success/20 text-success space-y-1.5">
                                <div class="flex items-center justify-between text-[11px] font-medium">
                                    <span>Cloud Object Key (Disimpan di Form):</span>
                                    <vibe:badge variant="success" size="xs">Direct PUT Validated</vibe:badge>
                                </div>
                                <div class="font-mono text-[11px] break-all select-all font-semibold bg-background/50 p-2 rounded border border-success/20" x-text="s3Key"></div>
                            </div>
                        </vibe:card> --}}



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
            'filename' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            'size' => ['nullable', 'integer'],
        ]);

        $rawFilename = $request->filename ?? Str::random(10);
        $extension = pathinfo($rawFilename, PATHINFO_EXTENSION);
        $hashedName = hash('sha256', $rawFilename . microtime()) . ($extension ? '.' . $extension : '');

        $url = Storage::temporaryUploadUrl(
            'public/presigned/' . $hashedName,
            now()->addMinutes(15)
        );

        // $url = Storage::temporaryUploadUrl('public/presigned/' . ($request->filename ?? Str::random(10)), now()->addMinutes(15));

        return response()->json([
            'url' => $url,
            'method' => 'PUT',
        ]);
    }
                    </vibe:highlightjs>
                </vibe:card>
            </section>

            {{-- 6. Form Submission & Backend Controller --}}
            <section id="form-controller" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Form Submission & Controller ($request->all())</h2>
                    <p class="text-sm text-muted-foreground">
                        Komponen &lt;vibe:filepond&gt; dapat digunakan di dalam formulir dan diposting langsung ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FilepondController@requestTest</code>. Saat form dikirim, modal pengujian otomatis muncul menampilkan payload <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code> dan kunci berkas secara real-time.
                    </p>
                </div>

                {{-- Alert Proteksi Upload Berlangsung --}}
                <div class="p-3.5 rounded-xl border border-warning/30 bg-warning/5 flex items-start gap-3 text-xs text-muted-foreground leading-relaxed">
                    <svg class="size-4 text-warning shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10" />
                        <path d="m9 12 2 2 4-4" />
                    </svg>
                    <div>
                        <strong class="text-foreground font-semibold">Proteksi Submit Saat Upload Berlangsung (<code class="font-mono text-[11px] text-warning">protect-upload="true"</code>):</strong>
                        Jika pengguna menekan tombol submit atau mencoba berpindah halaman sementara berkas masih dalam proses upload, Vibe UI akan secara otomatis mencegat aksi tersebut dan menampilkan dialog proteksi penutupan tab peramban.
                    </div>
                </div>

                <vibe:preview title="Pengujian Form Submission Sederhana">
                    <vibe:preview.code>
                        <\vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-lg">
                            <\vibe:filepond name="dokumen_test" label="Dokumen Uji Coba" max-file-size="5MB" />

                            <div class="flex justify-end pt-2">
                                <\vibe:button type="submit" variant="primary">
                                    Simpan & Uji Request
                                </\vibe:button>
                            </div>
                        </\vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-lg">
                        <vibe:form action="{{ route('docs.filepond.request_test') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            <vibe:filepond id="doc-test" name="dokumen_test" label="Dokumen Uji Coba" max-file-size="5MB" />

                            <div class="flex justify-end pt-2">
                                <vibe:button type="submit" variant="primary">
                                    <svg class="size-3.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m22 2-7 20-4-9-9-4Z" />
                                        <path d="M22 2 11 13" />
                                    </svg>
                                    Simpan & Uji Request
                                </vibe:button>
                            </div>
                        </vibe:form>
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

                    @php
                        $livewireBladeCode = <<<'BLADE'
                        <form wire:submit="save">
                            <vibe:filepond
                                wire:model="photos"
                                label="Foto Galeri"
                                multiple
                                max-files="5"
                                accepted-file-types="image/*"
                            />

                            <vibe:button type="submit" class="mt-4">Simpan Galeri</vibe:button>
                        </form>
                        BLADE;
                    @endphp
                    <vibe:highlightjs language="blade" :code="$livewireBladeCode" />
                </vibe:card>
            </section>

            {{-- 8. Manajemen Event & Pelacakan Berkas (vibe-filepond) --}}
            <section id="event-filepond" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Event & Pelacakan Aksi</h2>
                    <p class="text-sm text-muted-foreground">
                        Komponen <code class="text-xs font-mono text-primary font-semibold">&lt;vibe:filepond&gt;</code> memancarkan event terpadu <code class="text-xs font-mono text-primary font-semibold">vibe-filepond</code> ke level window dan elemen. Anda dapat membedakan instans FilePond dengan memeriksa <code class="text-xs font-mono text-primary font-semibold">if ($event.detail.id === '...')</code>.
                    </p>
                </div>

                {{-- Tabel Event & Aksi --}}
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">Nilai $event.detail.event</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">Target</vibe:table.column>
                        <vibe:table.column>Keterangan & Waktu Dipicu</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">add</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">Window & Element</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Dipicu saat berkas baru dipilih dari perangkat dan masuk ke antrean FilePond.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">start</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">Window & Element</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Dipicu ketika proses transfer/pengunggahan berkas mulai berjalan.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">progress</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">Window & Element</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Dipicu real-time membawa persentase pengunggahan (<code class="font-mono text-[11px]">$event.detail.progress</code> dari 0 - 100%).</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">success</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">Window & Element</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Dipicu ketika berkas tuntas terunggah dan kunci penyimpanan (<code class="font-mono text-[11px]">$event.detail.key</code>) telah diterima.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">revert</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">Window & Element</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Dipicu ketika berkas yang <strong>sudah selesai diunggah dibatalkan/dihapus</strong> oleh pengguna (tombol undo).</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">abort</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">Window & Element</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Dipicu ketika proses upload yang <strong>sedang berlangsung</strong> dihentikan sebelum tuntas.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">remove</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">Window & Element</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Dipicu ketika item berkas dikeluarkan dari antrean pond.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-primary whitespace-nowrap">error</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground whitespace-nowrap">Window & Element</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">Dipicu jika berkas tidak lolos validasi ukuran/format atau server gagal menerima berkas.</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>

                {{-- Card Struktur Payload Event --}}
                <div class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">1. Struktur Payload Objek (<code class="font-mono text-xs text-primary">$event.detail</code>)</h3>
                    <p class="text-xs text-muted-foreground">
                        Setiap event membawa detail payload yang seragam dan kaya informasi:
                    </p>
                    <vibe:card class="space-y-3 bg-muted/30">
                        <vibe:highlightjs language="javascript">
                            // Objek $event.detail yang dikirimkan pada setiap event
                            {
                            id: 'avatar', // [string] ID komponen FilePond (contoh: id="avatar")
                            name: 'avatar_input', // [string] Nilai atribut name input form
                            event: 'success', // [string] Jenis aksi ('add', 'start', 'progress', 'success', 'revert', 'abort', 'remove', 'error')
                            file: File, // [File|null] Objek berkas native JavaScript (name, size, type)
                            filename: 'profil.png', // [string] Nama berkas yang sedang diproses
                            size: 1048576, // [number] Ukuran berkas dalam bytes
                            type: 'image/png', // [string] Format MIME type
                            progress: 100, // [number] Persentase upload real-time (0 hingga 100)
                            loaded: 1048576, // [number] Jumlah bytes yang telah terkirim
                            total: 1048576, // [number] Total ukuran berkas dalam bytes
                            key: 'uploads/foto.jpg', // [string|null] Storage key cloud storage (S3 / R2 / GCS)
                            keys: ['...'], // [array] Seluruh storage key berkas yang telah terunggah
                            error: null, // [string|object|null] Pesan/objek error jika terjadi galat
                            pond: FilePondInstance // [object] Instance FilePond aktif untuk kontrol manual
                            }
                        </vibe:highlightjs>
                    </vibe:card>
                </div>

                @php
$eventPatternACode = <<<'BLADE'
<div @vibe-filepond.window="
    if ($event.detail.id === 'avatar') {
        if ($event.detail.event === 'success') {
            console.log('Avatar sukses:', $event.detail.key);
        }
        if ($event.detail.event === 'revert') {
            console.log('Avatar dibatalkan:', $event.detail.key);
        }
    }
">
    <vibe:filepond id="avatar" name="avatar" />
</div>
BLADE;

$eventPatternBCode = <<<'BLADE'
<div 
    @vibe-filepond:success.window="
        if ($event.detail.id === 'dokumen') {
            alert('Upload tuntas: ' + $event.detail.filename);
        }
    "
    @vibe-filepond:revert.window="
        if ($event.detail.id === 'dokumen') {
            alert('Berkas dibatalkan: ' + $event.detail.key);
        }
    "
>
    <vibe:filepond id="dokumen" name="doc" />
</div>
BLADE;

$eventPatternCCode = <<<'BLADE'
<vibe:filepond 
    id="profil" 
    name="foto"
    @file-add="console.log('Berkas dipilih:', $event.detail.filename)"
    @file-success="console.log('Selesai:', $event.detail.key)"
    @file-revert="console.log('Dibatalkan:', $event.detail.key)"
    @file-error="alert('Gagal: ' + $event.detail.error)"
/>
BLADE;

$eventPatternDCode = <<<'JS'
window.addEventListener('vibe-filepond', (event) => {
    const { id, event: action, filename, key } = event.detail;

    if (id === 'avatar' && action === 'revert') {
        console.warn('Hapus foto dari storage:', key);
    }
});
JS;

$recipe1Code = <<<'BLADE'
<vibe:filepond id="ktp_upload" name="ktp" presign-url="/api/presigned" />
<p id="ktp-status" class="mt-2 text-xs text-muted-foreground"></p>

<script>
window.addEventListener('vibe-filepond', (event) => {
    const { id, event: action, key, filename } = event.detail;
    if (id !== 'ktp_upload') return;

    const statusEl = document.getElementById('ktp-status');

    // 1. Saat berkas sukses diunggah ke storage
    if (action === 'success') {
        statusEl.textContent = `Berkas tersimpan: ${key}`;
        console.log('Upload berhasil:', filename, key);
    }

    // 2. Saat berkas yang sudah diunggah dibatalkan/dihapus oleh pengguna
    if (action === 'revert') {
        // Panggil endpoint API untuk menghapus file di cloud storage/backend
        fetch('/api/storage/delete', {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ key })
        });

        statusEl.textContent = 'Berkas telah dibatalkan & dibersihkan dari server.';
        console.warn('Berkas dibatalkan oleh pengguna:', key);
    }
});
</script>
BLADE;

$recipe2Code = <<<'BLADE'
<form id="permohonan-form" action="/simpan-data" method="POST">
    <vibe:filepond id="dokumen_permohonan" name="dokumen" />

    <div class="mt-4 flex justify-end">
        <vibe:button id="btn-submit" type="submit" variant="primary">
            <span id="btn-text">Simpan Permohonan</span>
        </vibe:button>
    </div>
</form>

<script>
const submitBtn = document.getElementById('btn-submit');
const btnText = document.getElementById('btn-text');

window.addEventListener('vibe-filepond', (event) => {
    const { id, event: action } = event.detail;
    if (id !== 'dokumen_permohonan') return;

    // Kunci tombol submit saat proses pengunggahan dimulai
    if (action === 'start') {
        submitBtn.disabled = true;
        btnText.textContent = 'Sedang mengunggah berkas...';
    }

    // Aktifkan kembali saat upload selesai, dibatalkan, atau gagal
    if (['success', 'error', 'abort', 'revert'].includes(action)) {
        submitBtn.disabled = false;
        btnText.textContent = 'Simpan Permohonan';
    }
});
</script>
BLADE;

$recipe3Code = <<<'BLADE'
<vibe:filepond id="video_upload" name="video" presign-url="/api/presigned" />

<!-- Bilah kemajuan kustom Vanilla JS -->
<div id="video-progress-box" class="mt-3 space-y-1 text-xs" style="display: none;">
    <div class="flex justify-between font-medium">
        <span>Mengunggah ke Cloud Storage...</span>
        <span id="video-progress-text">0%</span>
    </div>
    <div class="w-full bg-muted h-2 rounded-full overflow-hidden">
        <div id="video-progress-bar" class="bg-primary h-full transition-all duration-150" style="width: 0%"></div>
    </div>
</div>

<script>
const progressBox = document.getElementById('video-progress-box');
const progressText = document.getElementById('video-progress-text');
const progressBar = document.getElementById('video-progress-bar');

window.addEventListener('vibe-filepond', (event) => {
    const { id, event: action, progress } = event.detail;
    if (id !== 'video_upload') return;

    if (action === 'start') {
        progressBox.style.display = 'block';
        progressBar.style.width = '0%';
        progressText.textContent = '0%';
    }

    if (action === 'progress') {
        progressBar.style.width = `${progress}%`;
        progressText.textContent = `${progress}%`;
    }

    if (action === 'success') {
        progressBar.style.width = '100%';
        progressText.textContent = '100%';
        setTimeout(() => {
            progressBox.style.display = 'none';
        }, 2000);
    }

    if (['abort', 'error', 'revert'].includes(action)) {
        progressBox.style.display = 'none';
    }
});
</script>
BLADE;

$demoLiveMonitorCode = <<<'BLADE'
<div class="space-y-4" x-data="{
    currentAction: 'idle',
    currentFilename: '',
    currentProgress: 0,
    currentKey: null,
    isUploading: false,
    logs: [],
    handleEvent(detail) {
        if (detail.id !== 'demo-event-pond') return;
        if (!detail.event) return; // abaikan event legacy tanpa field 'event' (e.g. vibe-filepond-presigned-success)

        this.currentAction = detail.event;
        this.currentFilename = detail.filename || '-';

        if (detail.event === 'start') {
            this.isUploading = true;
            this.currentProgress = 0;
            this.currentKey = null;
        } else if (detail.event === 'progress') {
            this.isUploading = true;
            this.currentProgress = detail.progress || 0;
        } else if (detail.event === 'success') {
            this.isUploading = false;
            this.currentProgress = 100;
            this.currentKey = detail.key;
        } else if (['abort', 'error', 'revert', 'remove'].includes(detail.event)) {
            this.isUploading = false;
            if (detail.event !== 'revert') {
                this.currentProgress = 0;
            }
        }

        // Perbarui log progres terakhir jika beruntun
        const lastLog = this.logs[0];
        if (detail.event === 'progress' && lastLog && lastLog.action === 'progress') {
            lastLog.detail = detail.progress + '%';
            lastLog.progress = detail.progress;
            lastLog.time = new Date().toLocaleTimeString();
            return;
        }

        let detailText = '';
        if (detail.event === 'progress') detailText = detail.progress + '%';
        else if (detail.event === 'success') detailText = detail.key || 'Selesai';
        else if (detail.event === 'revert') detailText = 'Batal (' + (detail.key || '-') + ')';
        else if (detail.event === 'error') detailText = detail.error || 'Galat';
        else detailText = detail.size ? (detail.size / 1024).toFixed(1) + ' KB' : '-';

        this.logs.unshift({
            time: new Date().toLocaleTimeString(),
            action: detail.event,
            name: detail.filename || '-',
            detail: detailText
        });

        if (this.logs.length > 7) this.logs.pop();
    },
    clearLogs() {
        this.logs = [];
        this.currentAction = 'idle';
        this.currentFilename = '';
        this.currentProgress = 0;
        this.currentKey = null;
        this.isUploading = false;
    }
}" @vibe-filepond.window="handleEvent($event.detail)">

    {{-- Dropzone dengan simulasi upload untuk uji coba event --}}
    <vibe:filepond id="demo-event-pond" name="demo_event" label="Pilih Berkas untuk Menguji Event" :presign-url="route('docs.filepond.presigned')" presign-method="PUT"/>

    {{-- Kartu Status Real-Time & Progress Bar --}}
    <div class="p-4 rounded-xl border border-border bg-card/60 space-y-3">
        <div class="flex items-center justify-between gap-2 border-b border-border/60 pb-3">
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-foreground">Status Aktivitas:</span>
                <span class="text-[11px] font-mono px-2 py-0.5 rounded-full font-bold uppercase"
                    :class="{
                        'bg-muted text-muted-foreground': currentAction === 'idle',
                        'bg-primary/15 text-primary': currentAction === 'add',
                        'bg-amber-500/15 text-amber-600': currentAction === 'start',
                        'bg-sky-500/15 text-sky-600': currentAction === 'progress',
                        'bg-emerald-500/15 text-emerald-600': currentAction === 'success',
                        'bg-rose-500/15 text-rose-600': currentAction === 'revert',
                        'bg-orange-500/15 text-orange-600': currentAction === 'abort',
                        'bg-zinc-500/15 text-zinc-600': currentAction === 'remove',
                        'bg-red-500/15 text-red-600': currentAction === 'error',
                    }"
                    x-text="currentAction">
                </span>
            </div>

            <button type="button" @click="clearLogs" class="text-[11px] text-muted-foreground hover:text-foreground underline cursor-pointer">
                Reset Log
            </button>
        </div>

        {{-- Bilah Kemajuan (tampil dinamis saat upload berlangsung) --}}
        <div x-show="currentProgress > 0 || isUploading" x-transition class="space-y-1.5 pt-1">
            <div class="flex items-center justify-between text-xs font-medium">
                <span class="text-foreground truncate max-w-65" x-text="currentFilename"></span>
                <span class="font-mono text-primary font-bold" x-text="currentProgress + '%'"></span>
            </div>
            <div class="w-full bg-muted h-2 rounded-full overflow-hidden">
                <div class="h-full transition-all duration-200"
                    :class="currentAction === 'success' ? 'bg-emerald-500' : 'bg-primary'"
                    :style="'width: ' + currentProgress + '%'"></div>
            </div>
        </div>

        {{-- Key Penyimpanan Cloud saat Berhasil --}}
        <div x-show="currentKey" x-transition class="text-[11px] font-mono p-2 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 flex items-center justify-between">
            <span>Storage Key:</span>
            <span class="font-bold truncate max-w-70" x-text="currentKey"></span>
        </div>

        {{-- Aliran Riwayat Event --}}
        <div class="space-y-1 pt-1">
            <div class="text-[11px] font-medium text-muted-foreground">Riwayat Event Terakhir:</div>
            <template x-if="logs.length === 0">
                <div class="text-[11px] text-muted-foreground/70 italic py-1">Belum ada event yang tertangkap. Silakan pilih berkas di atas.</div>
            </template>
            <template x-for="(log, idx) in logs" :key="idx">
                <div class="flex items-center justify-between text-[11px] font-mono text-muted-foreground border-t border-border/40 py-1 gap-2">
                    <div class="flex items-center gap-1.5 truncate">
                        <span class="text-[10px] text-muted-foreground/60" x-text="log.time"></span>
                        <span class="px-1.5 py-0.2 rounded text-[10px] font-bold"
                            :class="{
                                'bg-primary/10 text-primary': log.action === 'add',
                                'bg-amber-500/10 text-amber-600': log.action === 'start',
                                'bg-sky-500/10 text-sky-600': log.action === 'progress',
                                'bg-emerald-500/10 text-emerald-600': log.action === 'success',
                                'bg-rose-500/10 text-rose-600': log.action === 'revert',
                                'bg-orange-500/10 text-orange-600': log.action === 'abort',
                                'bg-zinc-500/10 text-zinc-500': log.action === 'remove',
                                'bg-red-500/10 text-red-600': log.action === 'error'
                            }"
                            x-text="'[' + log.action + ']'"></span>
                        <span class="text-foreground truncate max-w-45" x-text="log.name"></span>
                    </div>
                    <span class="text-[10px] shrink-0 font-medium" x-text="log.detail"></span>
                </div>
            </template>
        </div>
    </div>
</div>
BLADE;
                @endphp

                {{-- 4 Pola Mendengarkan Event --}}
                <div class="space-y-3 pt-2">
                    <h3 class="text-base font-semibold text-foreground">2. Empat Cara Mendengarkan Event</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <vibe:card class="space-y-2 p-4 text-xs">
                            <div class="font-bold text-foreground flex items-center gap-1.5">
                                <span class="size-2 rounded-full bg-primary inline-block"></span>
                                Pola A: Event Terpadu dengan Filter ID (Rekomendasi)
                            </div>
                            <p class="text-muted-foreground text-[11px]">Dengarkan satu event <code class="font-mono text-primary font-semibold">vibe-filepond</code> lalu filter ID komponen:</p>
                            <vibe:highlightjs language="blade" :code="$eventPatternACode" />
                        </vibe:card>

                        <vibe:card class="space-y-2 p-4 text-xs">
                            <div class="font-bold text-foreground flex items-center gap-1.5">
                                <span class="size-2 rounded-full bg-success inline-block"></span>
                                Pola B: Event Berdasarkan Aksi Tertentu
                            </div>
                            <p class="text-muted-foreground text-[11px]">Dengarkan hanya jenis event tertentu dengan akhiran <code class="font-mono text-success font-semibold">:{action}</code>:</p>
                            <vibe:highlightjs language="blade" :code="$eventPatternBCode" />
                        </vibe:card>

                        <vibe:card class="space-y-2 p-4 text-xs">
                            <div class="font-bold text-foreground flex items-center gap-1.5">
                                <span class="size-2 rounded-full bg-warning inline-block"></span>
                                Pola C: Event Lokal pada Tag Komponen
                            </div>
                            <p class="text-muted-foreground text-[11px]">Langsung pasang listener shorthand pada tag <code class="font-mono text-warning font-semibold">&lt;vibe:filepond&gt;</code> tanpa modifier window:</p>
                            <vibe:highlightjs language="blade" :code="$eventPatternCCode" />
                        </vibe:card>

                        <vibe:card class="space-y-2 p-4 text-xs">
                            <div class="font-bold text-foreground flex items-center gap-1.5">
                                <span class="size-2 rounded-full bg-accent inline-block"></span>
                                Pola D: Vanilla JavaScript Murni
                            </div>
                            <p class="text-muted-foreground text-[11px]">Gunakan <code class="font-mono text-accent font-semibold">window.addEventListener</code> di file script JavaScript eksternal:</p>
                            <vibe:highlightjs language="javascript" :code="$eventPatternDCode" />
                        </vibe:card>
                    </div>
                </div>

                {{-- 3 Resep Kasus Nyata --}}
                <div class="space-y-3 pt-2">
                    <h3 class="text-base font-semibold text-foreground">3. Contoh Kasus Penggunaan Riil (Cookbook Recipes)</h3>

                    {{-- Resep 1: Pembatalan Revert --}}
                    <vibe:card class="space-y-3 p-4 text-xs border-l-4 border-l-destructive">
                        <div class="font-bold text-foreground text-sm">Resep 1: Menangani Pembatalan Berkas yang Sudah Diunggah (<code class="font-mono text-xs text-destructive">event === 'revert'</code>)</div>
                        <p class="text-muted-foreground leading-relaxed">
                            Ketika pengguna menekan tombol silang / <em>undo</em> pada berkas yang sudah berhasil tersimpan di cloud storage, tangkap event <code class="font-mono text-xs text-destructive">revert</code> untuk menghapus storage key dari state formulir atau mengirim request penghapusan berkas ke server:
                        </p>
                        <vibe:highlightjs language="blade" :code="$recipe1Code" />
                    </vibe:card>

                    {{-- Resep 2: Auto-Disable Tombol Submit --}}
                    <vibe:card class="space-y-3 p-4 text-xs border-l-4 border-l-primary">
                        <div class="font-bold text-foreground text-sm">Resep 2: Menonaktifkan Tombol Submit Selama Berkas Diunggah</div>
                        <p class="text-muted-foreground leading-relaxed">
                            Kunci tombol simpan saat proses transfer dimulai (<code class="font-mono text-xs text-primary">start</code>) dan buka kembali saat selesai (<code class="font-mono text-xs text-primary">success</code>), dibatalkan (<code class="font-mono text-xs text-primary">abort</code>), atau gagal (<code class="font-mono text-xs text-primary">error</code>):
                        </p>
                        <vibe:highlightjs language="blade" :code="$recipe2Code" />
                    </vibe:card>

                    {{-- Resep 3: Custom Progress Bar --}}
                    <vibe:card class="space-y-3 p-4 text-xs border-l-4 border-l-success">
                        <div class="font-bold text-foreground text-sm">Resep 3: Bilah Kemajuan Kustom Real-Time (<code class="font-mono text-xs text-success">event === 'progress'</code>)</div>
                        <p class="text-muted-foreground leading-relaxed">
                            Memonitor persentase pengiriman data ke server/storage secara real-time untuk membuat visual progress bar mandiri di luar komponen:
                        </p>
                        <vibe:highlightjs language="blade" :code="$recipe3Code" />
                    </vibe:card>
                </div>

                {{-- Preview Live Monitor Event --}}
                <div class="pt-2">
                    <vibe:preview title="Demo Pemantauan Event Real-Time" :code="$demoLiveMonitorCode">
                        <div class="w-full max-w-xl space-y-4" x-data="{
                            currentAction: 'idle',
                            currentFilename: '',
                            currentProgress: 0,
                            currentKey: null,
                            isUploading: false,
                            logs: [],
                            handleEvent(detail) {
                                if (detail.id !== 'demo-event-pond') return;
                                if (!detail.event) return; // abaikan event legacy tanpa field 'event'
                        
                                this.currentAction = detail.event;
                                this.currentFilename = detail.filename || '-';
                        
                                if (detail.event === 'start') {
                                    this.isUploading = true;
                                    this.currentProgress = 0;
                                    this.currentKey = null;
                                } else if (detail.event === 'progress') {
                                    this.isUploading = true;
                                    this.currentProgress = detail.progress || 0;
                                } else if (detail.event === 'success') {
                                    this.isUploading = false;
                                    this.currentProgress = 100;
                                    this.currentKey = detail.key;
                                } else if (['abort', 'error', 'revert', 'remove'].includes(detail.event)) {
                                    this.isUploading = false;
                                    if (detail.event !== 'revert') {
                                        this.currentProgress = 0;
                                    }
                                }
                        
                                // Perbarui log progres terakhir jika beruntun
                                const lastLog = this.logs[0];
                                if (detail.event === 'progress' && lastLog && lastLog.action === 'progress') {
                                    lastLog.detail = detail.progress + '%';
                                    lastLog.progress = detail.progress;
                                    lastLog.time = new Date().toLocaleTimeString();
                                    return;
                                }
                        
                                let detailText = '';
                                if (detail.event === 'progress') detailText = detail.progress + '%';
                                else if (detail.event === 'success') detailText = detail.key || 'Selesai';
                                else if (detail.event === 'revert') detailText = 'Batal (' + (detail.key || '-') + ')';
                                else if (detail.event === 'error') detailText = detail.error || 'Galat';
                                else detailText = detail.size ? (detail.size / 1024).toFixed(1) + ' KB' : '-';
                        
                                this.logs.unshift({
                                    time: new Date().toLocaleTimeString(),
                                    action: detail.event,
                                    name: detail.filename || '-',
                                    detail: detailText
                                });
                        
                                if (this.logs.length > 7) this.logs.pop();
                            },
                            clearLogs() {
                                this.logs = [];
                                this.currentAction = 'idle';
                                this.currentFilename = '';
                                this.currentProgress = 0;
                                this.currentKey = null;
                                this.isUploading = false;
                            }
                        }" @vibe-filepond.window="handleEvent($event.detail)">

                            {{-- Dropzone dengan simulasi upload untuk uji coba event --}}
                            <vibe:filepond id="demo-event-pond" name="demo_event" label="Pilih Berkas untuk Menguji Event" :presign-url="route('docs.filepond.presigned')" presign-method="PUT"/>

                            {{-- Kartu Status Real-Time & Progress Bar --}}
                            <div class="p-4 rounded-xl border border-border bg-card/60 space-y-3">
                                <div class="flex items-center justify-between gap-2 border-b border-border/60 pb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-semibold text-foreground">Status Aktivitas:</span>
                                        <span class="text-[11px] font-mono px-2 py-0.5 rounded-full font-bold uppercase transition-colors" :class="{
                                            'bg-muted text-muted-foreground': currentAction === 'idle',
                                            'bg-primary/15 text-primary border border-primary/30': currentAction === 'add',
                                            'bg-amber-500/15 text-amber-600 dark:text-amber-400 border border-amber-500/30': currentAction === 'start',
                                            'bg-sky-500/15 text-sky-600 dark:text-sky-400 border border-sky-500/30': currentAction === 'progress',
                                            'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30': currentAction === 'success',
                                            'bg-rose-500/15 text-rose-600 dark:text-rose-400 border border-rose-500/30': currentAction === 'revert',
                                            'bg-orange-500/15 text-orange-600 dark:text-orange-400 border border-orange-500/30': currentAction === 'abort',
                                            'bg-zinc-500/15 text-zinc-600 dark:text-zinc-400 border border-zinc-500/30': currentAction === 'remove',
                                            'bg-red-500/15 text-red-600 dark:text-red-400 border border-red-500/30': currentAction === 'error',
                                        }" x-text="currentAction">
                                        </span>
                                    </div>

                                    <button type="button" @click="clearLogs" class="text-[11px] text-muted-foreground hover:text-foreground underline cursor-pointer">
                                        Reset Log
                                    </button>
                                </div>

                                {{-- Bilah Kemajuan (tampil dinamis saat upload berlangsung) --}}
                                <div x-show="currentProgress > 0 || isUploading" x-transition class="space-y-1.5 pt-1">
                                    <div class="flex items-center justify-between text-xs font-medium">
                                        <span class="text-foreground truncate max-w-xs" x-text="currentFilename"></span>
                                        <span class="font-mono text-primary font-bold" x-text="currentProgress + '%'"></span>
                                    </div>
                                    <div class="w-full bg-muted h-2 rounded-full overflow-hidden">
                                        <div class="h-full transition-all duration-200" :class="currentAction === 'success' ? 'bg-emerald-500' : 'bg-primary'" :style="'width: ' + currentProgress + '%'"></div>
                                    </div>
                                </div>

                                {{-- Key Penyimpanan Cloud saat Berhasil --}}
                                <div x-show="currentKey" x-transition class="text-[11px] font-mono p-2 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-between">
                                    <span>Storage Key:</span>
                                    <span class="font-bold truncate max-w-xs" x-text="currentKey"></span>
                                </div>

                                {{-- Aliran Riwayat Event --}}
                                <div class="space-y-1 pt-1">
                                    <div class="text-[11px] font-medium text-muted-foreground">Riwayat Event Terakhir:</div>
                                    <template x-if="logs.length === 0">
                                        <div class="text-[11px] text-muted-foreground/70 italic py-1">Belum ada event yang tertangkap. Silakan pilih atau drop berkas di atas.</div>
                                    </template>
                                    <template x-for="(log, idx) in logs" :key="idx">
                                        <div class="flex items-center justify-between text-[11px] font-mono text-muted-foreground border-t border-border/40 py-1 gap-2">
                                            <div class="flex items-center gap-1.5 truncate">
                                                <span class="text-[10px] text-muted-foreground/60" x-text="log.time"></span>
                                                <span class="px-1.5 py-0.2 rounded text-[10px] font-bold" :class="{
                                                    'bg-primary/10 text-primary': log.action === 'add',
                                                    'bg-amber-500/10 text-amber-600': log.action === 'start',
                                                    'bg-sky-500/10 text-sky-600': log.action === 'progress',
                                                    'bg-emerald-500/10 text-emerald-600': log.action === 'success',
                                                    'bg-rose-500/10 text-rose-600': log.action === 'revert',
                                                    'bg-orange-500/10 text-orange-600': log.action === 'abort',
                                                    'bg-zinc-500/10 text-zinc-500': log.action === 'remove',
                                                    'bg-red-500/10 text-red-600': log.action === 'error'
                                                }" x-text="'[' + log.action + ']'"></span>
                                                <span class="text-foreground truncate max-w-48" x-text="log.name"></span>
                                            </div>
                                            <span class="text-[10px] shrink-0 font-medium" x-text="log.detail"></span>
                                        </div>
                                    </template>
                                </div>

                                <div class="text-[10px] text-muted-foreground/80 italic border-t border-border/40 pt-2">
                                    💡 Tip: Klik tombol silang (x) pada berkas yang telah sukses diunggah untuk memicu event <code class="font-mono text-rose-500 font-bold">revert</code>.
                                </div>
                            </div>
                        </div>
                    </vibe:preview>
                </div>
            </section>

            {{-- 12. Props Reference Table --}}
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
                            $filepondProps = [['name', 'string', 'null', 'Nama field input (otomatis diambil dari `wire:model` jika ada).'], ['size', 'string', '"md"', 'Pilihan ukuran ketinggian dropzone: `"sm"`, `"md"`, atau `"lg"`.'], ['title', 'string', 'null', 'Kustomisasi judul dropzone (default: "Choose a file or drag & drop it here").'], ['subtitle', 'string', 'null', 'Kustomisasi keterangan format dan ukuran (otomatis dihitung jika kosong).'], ['browse-label', 'string', 'null', 'Teks tombol pemilih berkas (default: "Browse File").'], ['icon', 'string', '"cloud"', 'Pilihan ikon dropzone (`cloud`, `upload`, `folder`, atau SVG string).'], ['variant', 'string', '"default"', 'Varian layout: `"default"` (lengkap), `"compact"` (horizontal), atau `"avatar"`.'], ['dashed', 'bool', 'true', 'Garis batas putus-putus (`true`) atau garis padat (`false`).'], ['drop-height', 'string', 'null', 'Tinggi minimal kustom dropzone, contoh: `"16rem"`, `"250px"`.'], ['multiple', 'bool', 'false', 'Mengizinkan pemilihan dan pengunggahan banyak berkas sekaligus.'], ['max-files', 'int', 'null', 'Batas maksimal jumlah berkas yang dapat diunggah bersamaan.'], ['max-file-size', 'string', 'null', 'Batas ukuran per berkas, contoh: `"2MB"`, `"500KB"`.'], ['accepted-file-types', 'string | array', 'null', 'Filter format mime berkas, contoh: `"image/*, application/pdf"`.'], ['avatar', 'bool', 'false', 'Mengaktifkan mode lingkaran compact 1:1 untuk foto profil.'], ['image-crop', 'bool', 'false', 'Mengaktifkan fitur pemotongan gambar otomatis/manual.'], ['image-crop-aspect-ratio', 'string', 'null', 'Rasio aspek pemotongan gambar, contoh: `"1:1"`, `"16:9"`.'], ['presign-url', 'string', 'null', 'Endpoint backend untuk mendapatkan URL presigned cloud storage.'], ['presign-method', 'string', '"PUT"', 'HTTP method pengunggahan langsung ke cloud storage.'], ['encode', 'bool', 'false', 'Mengonversi berkas ke base64 string untuk form submission standar.'], ['existing-files', 'array', '[]', 'Daftar URL berkas awal yang sudah ada (misal untuk form edit).'], ['protect-upload', 'bool', 'false', 'Mencegah submit form dan navigasi saat berkas masih diunggah dengan konfirmasi &lt;vibe:alert&gt; serta peringatan penutupan tab (`beforeunload`).'], ['protect-title', 'string', 'null', 'Kustomisasi judul alert proteksi unggah (default: "Unggahan Belum Selesai").'], ['protect-message', 'string', 'null', 'Kustomisasi pesan konfirmasi/peringatan ketika user mencoba mengirim form atau berpindah halaman saat upload berlangsung.']];
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

    {{-- Reusable Modal Pengujian $request->all() untuk FilePond --}}
    @include('docs.partials.filepond-test-modal')
</x-docs.layouts.sidebar>
