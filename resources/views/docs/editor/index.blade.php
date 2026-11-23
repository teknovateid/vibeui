<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/editor.title')" :description="__('docs/editor.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/editor.title'), 'url' => '/docs/editor']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/editor.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/editor.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/editor.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/editor.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['standard', 'minimal', 'basic', 'full'] as $p)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">preset="{{ $p }}"</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:variables="[...]"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">Vibe::parseTemplate()</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:autoresize="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">upload-url="..."</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">wire:model</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/editor.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/editor.basic_usage.preview_title')">
                    <vibe:preview.code>
                        <\vibe:editor 
                            name="article_body" 
                            label="{{ __('docs/editor.basic_usage.label') }}" 
                            placeholder="{{ __('docs/editor.basic_usage.placeholder') }}" 
                            :height="280" 
                        />
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:editor 
                            name="article_body" 
                            :label="__('docs/editor.basic_usage.label')" 
                            :placeholder="__('docs/editor.basic_usage.placeholder')" 
                            :height="280" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Variable Autocomplete & Dropdown --}}
            <section id="variabel-autocomplete" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.variables.title') }}</h2>
                        <vibe:badge variant="secondary" size="sm" class="rounded-full font-mono text-[11px]">Autocomplete</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/editor.variables.desc') !!}
                    </p>
                </div>

                @php
                    $demoVariables = [
                        'user' => [
                            'label' => 'Data Pengguna',
                            'items' => [
                                'name' => 'Nama Lengkap',
                                'email' => 'Alamat Email',
                                'phone' => 'Nomor WhatsApp',
                                'role' => 'Peran Akun',
                            ],
                        ],
                        'order' => [
                            'label' => 'Data Pesanan',
                            'items' => [
                                'number' => 'Nomor Pesanan',
                                'amount' => 'Total Pembayaran',
                                'status' => 'Status Transaksi',
                                'date' => 'Tanggal Pesanan',
                            ],
                        ],
                        'company' => [
                            'label' => 'Perusahaan',
                            'items' => [
                                'name' => 'Nama Toko / Perusahaan',
                                'support_email' => 'Email Bantuan',
                            ],
                        ],
                    ];
                @endphp

                @php
                    $sampleVarsCode = <<<'PHP'
$variables = [
    'user' => [
        'label' => 'Data Pengguna',
        'items' => [
            'name' => 'Nama Lengkap',
            'email' => 'Alamat Email',
            'phone' => 'Nomor WhatsApp',
        ],
    ],
    'order' => [
        'label' => 'Data Pesanan',
        'items' => [
            'number' => 'Nomor Pesanan',
            'amount' => 'Total Pembayaran',
            'status' => 'Status Transaksi',
        ],
    ],
    'company' => [
        'label' => 'Perusahaan',
        'items' => [
            'name' => 'Nama Toko / Perusahaan',
            'support_email' => 'Email Bantuan',
        ],
    ],
];
PHP;

                    $vibeParseSnippet = <<<'PHP'
use Teknovate\VibeUi\Vibe;

// 1. Ambil template HTML yang tersimpan dari database
$rawHtml = $template->body;

// 2. Siapkan data (Mendukung Eloquent Model, Objek, maupun Array bersarang)
$data = [
    'user' => $user, // Instance User model ($user->name, $user->email)
    'order' => [
        'number' => 'ORD-2026-9812',
        'amount' => number_format(250000, 0, ',', '.'),
        'status' => 'Lunas / Berhasil',
    ],
    'company' => [
        'name' => config('app.name', 'Teknovate Store'),
        'support_email' => 'helpdesk@teknovate.com',
    ],
];

// 3. Interpolasi template ke HTML murni siap kirim atau cetak PDF
$cleanHtml = Vibe::parseTemplate($rawHtml, $data);

// Atau gunakan helper function global:
$cleanHtml = vibe_parse_template($rawHtml, $data);
PHP;

                    $mailableSnippet = <<<'PHP'
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Teknovate\VibeUi\Vibe;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $templateHtml,
        public array $placeholders
    ) {}

    public function build()
    {
        // Parsing variabel ke HTML bersih (menghapus tag badge editor)
        $html = Vibe::parseTemplate($this->templateHtml, $this->placeholders);

        return $this->subject('Konfirmasi Pesanan #' . data_get($this->placeholders, 'order.number'))
                    ->html($html);
    }
}
PHP;

                    $manualRegexSnippet = <<<'PHP'
function customTemplateParser(string $html, array $data): string 
{
    // 1. Parsing tag badge <span class="vibe-editor-variable" data-variable="key">
    $html = preg_replace_callback(
        '/<span[^>]*class="[^"]*vibe-editor-variable[^"]*"[^>]*data-variable="([^"]+)"[^>]*>.*?<\/span>/is',
        function ($matches) use ($data) {
            $key = trim($matches[1]);
            $val = array_key_exists($key, $data) ? $data[$key] : data_get($data, $key, '');
            return htmlspecialchars((string) $val, ENT_QUOTES, 'UTF-8');
        },
        $html
    );

    // 2. Parsing token kurung kurawal ganda standar {{ key }}
    return preg_replace_callback(
        '/\{\{\s*([a-zA-Z0-9_\-\.]+)\s*\}\}/',
        function ($matches) use ($data) {
            $key = trim($matches[1]);
            $val = array_key_exists($key, $data) ? $data[$key] : data_get($data, $key, '');
            return htmlspecialchars((string) $val, ENT_QUOTES, 'UTF-8');
        },
        $html
    );
}
PHP;

                    $uploadApiSnippet = <<<'PHP'
// routes/api.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::post('/editor/upload', function (Request $request) {
    $request->validate([
        'file' => 'required|image|max:5120', // Maksimal 5MB
    ]);

    $path = $request->file('file')->store('editor-images', 'public');

    return response()->json([
        'location' => Storage::url($path),
    ]);
});
PHP;

                    $uploadBladeSnippet = '<vibe:editor name="blog_post" label="Konten Blog" upload-url="/api/editor/upload" />';

                    $livewireClassSnippet = <<<'PHP'
namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class ArticleForm extends Component
{
    public string $body = '<p>Konten awal dari Livewire...</p>';

    public function save()
    {
        // $this->body berisi string HTML terbaru dari TinyMCE
        Article::create(['body' => $this->body]);
    }

    public function render()
    {
        return view('livewire.article-form');
    }
}
PHP;

                    $livewireBladeSnippet = <<<'BLADE'
{{-- Debounced binding untuk performa optimal saat mengetik --}}
<vibe:editor 
    wire:model.live.debounce.500ms="body" 
    label="Isi Artikel" 
    :height="320" 
/>

<div class="mt-3 flex justify-end">
    <vibe:button wire:click="save" variant="primary">Simpan Artikel</vibe:button>
</div>
BLADE;
                @endphp

                <vibe:preview :title="__('docs/editor.variables.preview_title')">
                    <vibe:preview.code>
                        {{-- Data Array Variabel --}}
                        <div class="text-xs text-muted-foreground mb-2">Definisi data variabel di controller / komponen:</div>
                        <vibe:highlight language="php" title="Variabel Controller" :code="$sampleVarsCode" />

                        {{-- Tag vibe:editor --}}
                        <div class="text-xs text-muted-foreground mt-4 mb-2">Penggunaan tag komponen:</div>
                        <\vibe:editor 
                            name="notification_template" 
                            label="{{ __('docs/editor.variables.label') }}" 
                            placeholder="{{ __('docs/editor.variables.placeholder') }}"
                            :variables="$variables"
                            :height="300"
                        >
                            <p>Halo <span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="user.name">&#123;&#123; user.name &#125;&#125;</span>,</p>
                            <p>Terima kasih telah berbelanja di <strong><span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="company.name">&#123;&#123; company.name &#125;&#125;</span></strong>. Pesanan Anda dengan nomor <strong><span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="order.number">&#123;&#123; order.number &#125;&#125;</span></strong> sebesar <strong><span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="order.amount">&#123;&#123; order.amount &#125;&#125;</span></strong> saat ini berstatus <strong><span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="order.status">&#123;&#123; order.status &#125;&#125;</span></strong>.</p>
                            <p>Ketik tanda <code>&#123;&#123;</code> untuk mencoba menyisipkan variabel baru lainnya!</p>
                        </\vibe:editor>
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:editor 
                            name="notification_template" 
                            :label="__('docs/editor.variables.label')" 
                            :placeholder="__('docs/editor.variables.placeholder')"
                            :variables="$demoVariables"
                            :height="300"
                        >
                            <p>Halo <span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="user.name">@{{ user.name }}</span>,</p>
                            <p>Terima kasih telah berbelanja di <strong><span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="company.name">@{{ company.name }}</span></strong>. Pesanan Anda dengan nomor <strong><span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="order.number">@{{ order.number }}</span></strong> sebesar <strong><span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="order.amount">@{{ order.amount }}</span></strong> saat ini berstatus <strong><span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="order.status">@{{ order.status }}</span></strong>.</p>
                            <p>Ketik tanda <code>@{{</code> untuk mencoba menyisipkan variabel baru lainnya!</p>
                        </vibe:editor>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Backend Template Parsing --}}
            <section id="parsing-template" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.parsing.title') }}</h2>
                        <vibe:badge variant="primary" size="sm" class="rounded-full">{{ __('docs/editor.parsing.badge') }}</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/editor.parsing.desc') !!}
                    </p>
                </div>

                <div class="space-y-4">
                    {{-- 1. Built-in Vibe Helper --}}
                    <div class="rounded-xl border border-border bg-card p-5 space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-foreground flex items-center gap-2">
                                <span class="size-2 rounded-full bg-emerald-500"></span>
                                {{ __('docs/editor.parsing.method_title') }}
                            </h3>
                            <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">Vibe::parseTemplate()</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {!! __('docs/editor.parsing.method_desc') !!}
                        </p>

                        <vibe:highlight language="php" title="Controller / Service Integration" :code="$vibeParseSnippet" />
                    </div>

                    {{-- 2. Contoh Mailable Laravel --}}
                    <div class="rounded-xl border border-border bg-card p-5 space-y-3">
                        <div class="flex items-center gap-2">
                            <h3 class="text-sm font-semibold text-foreground">{{ __('docs/editor.parsing.mailable_title') }}</h3>
                            <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">Laravel Mailable</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {!! __('docs/editor.parsing.mailable_desc') !!}
                        </p>

                        <vibe:highlight language="php" title="app/Mail/OrderConfirmationMail.php" :code="$mailableSnippet" />
                    </div>

                    {{-- 3. Contoh Custom Regex Manual --}}
                    <div class="rounded-xl border border-border bg-card p-5 space-y-3">
                        <div class="flex items-center gap-2">
                            <h3 class="text-sm font-semibold text-foreground">{{ __('docs/editor.parsing.manual_title') }}</h3>
                            <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">Pure PHP / Regex</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {!! __('docs/editor.parsing.manual_desc') !!}
                        </p>

                        <vibe:highlight language="php" title="Custom Regex Parser" :code="$manualRegexSnippet" />
                    </div>
                </div>
            </section>

            {{-- 4. Toolbar Presets --}}
            <section id="preset-toolbar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.presets.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/editor.presets.desc') !!}
                    </p>
                    <ul class="list-disc list-inside text-xs text-muted-foreground space-y-1 pt-1">
                        <li>{!! __('docs/editor.presets.items.minimal') !!}</li>
                        <li>{!! __('docs/editor.presets.items.basic') !!}</li>
                        <li>{!! __('docs/editor.presets.items.standard') !!}</li>
                        <li>{!! __('docs/editor.presets.items.full') !!}</li>
                    </ul>
                </div>

                <vibe:preview :title="__('docs/editor.presets.preview_title')">
                    <vibe:preview.code>
                        {{-- Minimal Preset --}}
                        <\vibe:editor name="comment" label="{{ __('docs/editor.presets.minimal_label') }}" preset="minimal" :height="170" />

                        {{-- Full Preset --}}
                        <\vibe:editor name="full_doc" label="{{ __('docs/editor.presets.full_label') }}" preset="full" :menubar="true" :height="360" />
                    </vibe:preview.code>
                    <div class="w-full space-y-6">
                        <vibe:editor name="comment" :label="__('docs/editor.presets.minimal_label')" preset="minimal" :height="170" />
                        <vibe:editor name="full_doc" :label="__('docs/editor.presets.full_label')" preset="full" :menubar="true" :height="360" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Custom Toolbar & Plugins --}}
            <section id="custom-toolbar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.custom_toolbar.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/editor.custom_toolbar.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/editor.custom_toolbar.preview_title')">
                    <vibe:preview.code>
                        <\vibe:editor 
                            name="custom_editor" 
                            label="{{ __('docs/editor.custom_toolbar.label') }}" 
                            toolbar="undo redo | bold italic underline | bullist numlist | code" 
                            :plugins="['code', 'lists']" 
                            :height="220" 
                        />
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:editor 
                            name="custom_editor" 
                            :label="__('docs/editor.custom_toolbar.label')" 
                            toolbar="undo redo | bold italic underline | bullist numlist | code" 
                            :plugins="['code', 'lists']" 
                            :height="220" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Autoresize Mode --}}
            <section id="autoresize" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.autoresize.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/editor.autoresize.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/editor.autoresize.preview_title')">
                    <vibe:preview.code>
                        <\vibe:editor 
                            name="auto_content" 
                            label="{{ __('docs/editor.autoresize.label') }}" 
                            :autoresize="true" 
                            :min-height="160" 
                            :max-height="450" 
                            preset="basic" 
                        />
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:editor 
                            name="auto_content" 
                            :label="__('docs/editor.autoresize.label')" 
                            :autoresize="true" 
                            :min-height="160" 
                            :max-height="450" 
                            preset="basic" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Image Upload Integration --}}
            <section id="unggah-gambar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.image_upload.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/editor.image_upload.desc') !!}
                    </p>
                </div>

                <div class="rounded-xl border border-border bg-card p-5 space-y-3">
                    <div class="flex items-center gap-2">
                        <h3 class="text-sm font-semibold text-foreground">{{ __('docs/editor.image_upload.controller_title') }}</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">Laravel Route</vibe:badge>
                    </div>
                    <p class="text-xs text-muted-foreground">
                        {!! __('docs/editor.image_upload.controller_desc') !!}
                    </p>
                    <vibe:highlight language="php" title="routes/api.php" :code="$uploadApiSnippet" />

                    <div class="pt-2">
                        <div class="text-xs font-medium text-foreground mb-1">Penggunaan di template Blade:</div>
                        <vibe:highlight language="blade" :code="$uploadBladeSnippet" />
                    </div>
                </div>
            </section>

            {{-- 7. Livewire v3 Integration --}}
            <section id="livewire" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.livewire.title') }}</h2>
                        <vibe:badge variant="primary" size="sm" class="rounded-full">Livewire 3</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/editor.livewire.desc') !!}
                    </p>
                </div>

                <div class="rounded-xl border border-border bg-card p-5 space-y-4">
                    <div class="space-y-1.5">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">1. Komponen Livewire (PHP Class)</h4>
                        <vibe:highlight language="php" title="app/Livewire/ArticleForm.php" :code="$livewireClassSnippet" />
                    </div>

                    <div class="space-y-1.5">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">2. Template Blade Livewire</h4>
                        <vibe:highlight language="blade" title="resources/views/livewire/article-form.blade.php" :code="$livewireBladeSnippet" />
                    </div>
                </div>
            </section>

            {{-- 8. Interaction States (Readonly, Disabled, Error) --}}
            <section id="status-interaksi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.states.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/editor.states.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/editor.states.preview_title')">
                    <vibe:preview.code>
                        {{-- Readonly --}}
                        <\vibe:editor 
                            name="article_preview" 
                            label="{{ __('docs/editor.states.readonly_label') }}" 
                            :readonly="true" 
                            :height="180" 
                        >
                            <p>Artikel ini telah <strong>dipublikasikan</strong> secara resmi. Pengguna lain hanya dapat membaca dokumen ini tanpa dapat menyunting toolbar.</p>
                        </\vibe:editor>

                        {{-- Validation Error State --}}
                        <\vibe:editor 
                            name="summary" 
                            label="{{ __('docs/editor.states.error_label') }}" 
                            error="Bagian ringkasan artikel wajib diisi minimal 100 karakter." 
                            :height="180" 
                        />
                    </vibe:preview.code>
                    <div class="w-full space-y-6">
                        <vibe:editor 
                            name="article_preview" 
                            :label="__('docs/editor.states.readonly_label')" 
                            :readonly="true" 
                            :height="180" 
                        >
                            <p>Artikel ini telah <strong>dipublikasikan</strong> secara resmi. Pengguna lain hanya dapat membaca dokumen ini tanpa dapat menyunting toolbar.</p>
                        </vibe:editor>

                        <vibe:editor 
                            name="summary" 
                            :label="__('docs/editor.states.error_label')" 
                            error="Bagian ringkasan artikel wajib diisi minimal 100 karakter." 
                            :height="180" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Form Testing ($request->all()) --}}
            <section id="pengujian-form" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">Pengujian Form ($request->all())</h2>
                        <vibe:badge variant="primary" size="sm" class="rounded-full">Live Controller Test</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        Uji coba pengiriman nilai HTML editor langsung ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FormController@store</code>. Saat disubmit, modal otomatis muncul menampilkan payload <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code>.
                    </p>
                </div>

                <vibe:preview title="Form Testing Sandbox">
                    <vibe:preview.code>
                        <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-2xl mx-auto">
                            @csrf
                            <vibe:card>
                                <vibe:card.header>
                                    <h3 class="text-sm sm:text-base font-semibold text-foreground">Publikasi Artikel & Email Blast</h3>
                                    <p class="text-xs text-muted-foreground mt-0.5">Uji coba pengiriman konten WYSIWYG editor ke backend.</p>
                                </vibe:card.header>

                                <vibe:card.content class="space-y-4">
                                    <\vibe:editor 
                                        name="newsletter_content" 
                                        label="Konten Buletin (Newsletter)" 
                                        :variables="$variables" 
                                        :height="260" 
                                        required 
                                    />
                                </vibe:card.content>

                                <vibe:card.footer>
                                    <vibe:button class="w-full" type="submit" variant="primary">
                                        Kirim Form & Uji $request->all()
                                    </vibe:button>
                                </vibe:card.footer>
                            </vibe:card>
                        </vibe:form>
                    </vibe:preview.code>

                    <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-2xl mx-auto">
                        @csrf
                        <vibe:card>
                            <vibe:card.header>
                                <h3 class="text-sm sm:text-base font-semibold text-foreground">Publikasi Artikel & Email Blast</h3>
                                <p class="text-xs text-muted-foreground mt-0.5">Uji coba pengiriman konten WYSIWYG editor ke backend.</p>
                            </vibe:card.header>

                            <vibe:card.content class="space-y-4">
                                <vibe:editor 
                                    name="newsletter_content" 
                                    label="Konten Buletin (Newsletter)" 
                                    :variables="$demoVariables" 
                                    :height="260" 
                                    required 
                                />
                            </vibe:card.content>

                            <vibe:card.footer>
                                <vibe:button class="w-full" type="submit" variant="primary">
                                    Kirim Form & Uji $request->all()
                                </vibe:button>
                            </vibe:card.footer>
                        </vibe:card>
                    </vibe:form>
                </vibe:preview>
            </section>

            {{-- 10. Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/editor.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/editor.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/editor.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/editor.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/editor.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $editorProps = [
                                ['name', 'string', 'null', __('docs/editor.props.items.name')],
                                ['id', 'string', 'auto', __('docs/editor.props.items.id')],
                                ['label', 'string', 'null', __('docs/editor.props.items.label')],
                                ['description', 'string', 'null', __('docs/editor.props.items.description')],
                                ['placeholder', 'string', 'null', __('docs/editor.props.items.placeholder')],
                                ['preset', "'minimal'|'basic'|'standard'|'full'", "'standard'", __('docs/editor.props.items.preset')],
                                ['variables', 'array', '[]', __('docs/editor.props.items.variables')],
                                ['variableStyle', "'badge'|'raw'", "'badge'", __('docs/editor.props.items.variableStyle')],
                                ['variablePrefix', 'string', "'{{ '", __('docs/editor.props.items.variablePrefix')],
                                ['variableSuffix', 'string', "' }}'", __('docs/editor.props.items.variableSuffix')],
                                ['variableButtonLabel', 'string', "'Variabel'", __('docs/editor.props.items.variableButtonLabel')],
                                ['height', 'int|string', '350', __('docs/editor.props.items.height')],
                                ['minHeight', 'int', '200', __('docs/editor.props.items.minHeight')],
                                ['maxHeight', 'int', 'null', __('docs/editor.props.items.maxHeight')],
                                ['autoresize', 'bool', 'false', __('docs/editor.props.items.autoresize')],
                                ['menubar', 'bool|string', 'false', __('docs/editor.props.items.menubar')],
                                ['toolbar', 'string', 'null', __('docs/editor.props.items.toolbar')],
                                ['toolbarMode', 'string', "'sliding'", __('docs/editor.props.items.toolbarMode')],
                                ['toolbarSticky', 'bool', 'true', __('docs/editor.props.items.toolbarSticky')],
                                ['toolbarStickyOffset', 'int', '0', __('docs/editor.props.items.toolbarStickyOffset')],
                                ['plugins', 'array|string', 'null', __('docs/editor.props.items.plugins')],
                                ['uploadUrl', 'string', 'null', __('docs/editor.props.items.uploadUrl')],
                                ['uploadParam', 'string', "'file'", __('docs/editor.props.items.uploadParam')],
                                ['statusbar', 'bool', 'true', __('docs/editor.props.items.statusbar')],
                                ['readonly', 'bool', 'false', __('docs/editor.props.items.readonly')],
                                ['disabled', 'bool', 'false', __('docs/editor.props.items.disabled')],
                                ['required', 'bool', 'false', __('docs/editor.props.items.required')],
                                ['error', 'string|bool', 'null', __('docs/editor.props.items.error')],
                                ['errorName', 'string', 'null', __('docs/editor.props.items.errorName')],
                                ['info', 'string', 'null', __('docs/editor.props.items.info')],
                                ['wrapperClass', 'string', 'null', __('docs/editor.props.items.wrapperClass')],
                            ];
                        @endphp
                        @foreach ($editorProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>
            </section>

            {{-- 11. Slots Reference --}}
            <section id="referensi-slots" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.slots.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{{ __('docs/editor.slots.desc') }}</p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/editor.slots.columns.name') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/editor.slots.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">default</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{!! __('docs/editor.slots.items.default') !!}</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

            {{-- 12. Events & JS Integration --}}
            <section id="events-javascript" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/editor.events.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{{ __('docs/editor.events.desc') }}</p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/editor.events.columns.event') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/editor.events.columns.target') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/editor.events.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">change</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground whitespace-nowrap">{!! __('docs/editor.events.items.change') !!}</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{!! __('docs/editor.events.items.change_desc') !!}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">input</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground whitespace-nowrap">{!! __('docs/editor.events.items.input') !!}</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{!! __('docs/editor.events.items.input_desc') !!}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">vibe-editor-ready</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground whitespace-nowrap">{!! __('docs/editor.events.items.ready') !!}</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{!! __('docs/editor.events.items.ready_desc') !!}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">tinymce.get(id)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground whitespace-nowrap">{!! __('docs/editor.events.items.tinymce_get') !!}</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{!! __('docs/editor.events.items.tinymce_get_desc') !!}</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>
    </div>

    {{-- Reusable Modal Pengujian $request->all() --}}
    @include('docs.partials.form-test-modal')
</x-docs.layouts.sidebar>
