<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/highlight.title')" :description="__('docs/highlight.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/highlight.title'), 'url' => '/docs/highlight']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/highlight.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/highlight.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/highlight.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/highlight.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">language</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">title / filename</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">copyable</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">line-numbers</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">badge</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">max-height</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">wrap</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/highlight.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/highlight.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/highlight.basic_usage.preview_title')">
                    <vibe:preview.code>
<vibe:highlight language="php">
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }
}
</vibe:highlight>

<vibe:highlight language="javascript">
const calculateTotal = (items, taxRate = 0.11) => {
    const subtotal = items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    return subtotal + (subtotal * taxRate);
};
</vibe:highlight>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6 space-y-4">
                        <vibe:highlight language="php">
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }
}
                        </vibe:highlight>

                        <vibe:highlight language="javascript">
const calculateTotal = (items, taxRate = 0.11) => {
    const subtotal = items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    return subtotal + (subtotal * taxRate);
};
                        </vibe:highlight>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Titles & Terminal Auto-Detection --}}
            <section id="nama-file-terminal" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/highlight.titles_terminal.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/highlight.titles_terminal.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/highlight.titles_terminal.preview_title')">
                    <vibe:preview.code>
{{-- Header dengan Judul Path File --}}
<vibe:highlight
    language="php"
    title="routes/web.php"
>
use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
</vibe:highlight>

{{-- Deteksi Perintah Terminal Otomatis (Otomatis mendeteksi bash & memasang ikon terminal) --}}
<vibe:highlight>
php artisan make:model Product -mrc
composer require livewire/livewire
npm install && npm run dev
</vibe:highlight>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6 space-y-4">
                        <vibe:highlight
                            language="php"
                            title="routes/web.php"
                        >
use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
                        </vibe:highlight>

                        <vibe:highlight>
php artisan make:model Product -mrc
composer require livewire/livewire
npm install && npm run dev
                        </vibe:highlight>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Line Numbers --}}
            <section id="penomoran-baris" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/highlight.line_numbers.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/highlight.line_numbers.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/highlight.line_numbers.preview_title')">
                    <vibe:preview.code>
<vibe:highlight
    language="php"
    title="app/Services/PaymentService.php"
    line-numbers
>
namespace App\Services;

class PaymentService
{
    public function process(Order $order, string $gateway): Transaction
    {
        $handler = match ($gateway) {
            'stripe' => new StripeGateway(),
            'midtrans' => new MidtransGateway(),
            default => throw new InvalidGatewayException(),
        };

        return $handler->charge($order->total);
    }
}
</vibe:highlight>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:highlight
                            language="php"
                            title="app/Services/PaymentService.php"
                            line-numbers
                        >
namespace App\Services;

class PaymentService
{
    public function process(Order $order, string $gateway): Transaction
    {
        $handler = match ($gateway) {
            'stripe' => new StripeGateway(),
            'midtrans' => new MidtransGateway(),
            default => throw new InvalidGatewayException(),
        };

        return $handler->charge($order->total);
    }
}
                        </vibe:highlight>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Copy Button & Badges --}}
            <section id="tombol-salin-badge" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/highlight.copy_and_badges.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/highlight.copy_and_badges.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/highlight.copy_and_badges.preview_title')">
                    <vibe:preview.code>
{{-- Tanpa header: Tombol salin tampil melayang (floating) di pojok kanan atas --}}
<vibe:highlight
    language="bash"
    :header="false"
>
curl -sS https://getcomposer.org/installer | php
</vibe:highlight>

{{-- Badge Kustom --}}
<vibe:highlight
    language="php"
    title="bootstrap/app.php"
    badge="LARAVEL 11"
>
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(web: __DIR__.'/../routes/web.php')
    ->create();
</vibe:highlight>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6 space-y-4">
                        <vibe:highlight
                            language="bash"
                            :header="false"
                        >
curl -sS https://getcomposer.org/installer | php
                        </vibe:highlight>

                        <vibe:highlight
                            language="php"
                            title="bootstrap/app.php"
                            badge="LARAVEL 11"
                        >
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(web: __DIR__.'/../routes/web.php')
    ->create();
                        </vibe:highlight>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Height Limits & Word Wrap --}}
            <section id="batas-tinggi-wrap" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/highlight.height_wrap.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/highlight.height_wrap.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/highlight.height_wrap.preview_title')">
                    <vibe:preview.code>
{{-- Batasan tinggi vertikal dengan scrollbar: max-height="180" --}}
<vibe:highlight
    language="json"
    title="storage/app/deployment-log.json"
    :max-height="180"
    line-numbers
>
{
  "status": "success",
  "deployment_id": "deploy_2026_09_03",
  "environment": "production",
  "commit": "8f3b20c81a9",
  "steps": [
    { "name": "optimize:clear", "duration": "12ms" },
    { "name": "config:cache", "duration": "4ms" },
    { "name": "route:cache", "duration": "8ms" },
    { "name": "view:cache", "duration": "16ms" }
  ],
  "server": "web-cluster-sg-01"
}
</vibe:highlight>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:highlight
                            language="json"
                            title="storage/app/deployment-log.json"
                            :max-height="180"
                            line-numbers
                        >
{
  "status": "success",
  "deployment_id": "deploy_2026_09_03",
  "environment": "production",
  "commit": "8f3b20c81a9",
  "steps": [
    { "name": "optimize:clear", "duration": "12ms" },
    { "name": "config:cache", "duration": "4ms" },
    { "name": "route:cache", "duration": "8ms" },
    { "name": "view:cache", "duration": "16ms" }
  ],
  "server": "web-cluster-sg-01"
}
                        </vibe:highlight>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/highlight.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/highlight.props.desc') !!}
                    </p>
                </div>

                {{-- vibe:highlight Props --}}
                <p class="text-sm font-semibold text-foreground">&lt;vibe:highlight&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/highlight.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/highlight.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/highlight.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/highlight.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $hlProps = [
                                ['code', 'string|null', 'null', __('docs/highlight.props_items.code')],
                                ['language / lang', 'string|null', 'null', __('docs/highlight.props_items.language')],
                                ['title / filename', 'string|null', 'null', __('docs/highlight.props_items.title')],
                                ['copyable', 'bool', 'true', __('docs/highlight.props_items.copyable')],
                                ['lineNumbers / lines', 'bool', 'false', __('docs/highlight.props_items.lineNumbers')],
                                ['badge', 'bool|string', 'true', __('docs/highlight.props_items.badge')],
                                ['header', 'bool|null', 'null', __('docs/highlight.props_items.header')],
                                ['maxHeight', 'int|string|null', 'null', __('docs/highlight.props_items.maxHeight')],
                                ['wrap', 'bool', 'false', __('docs/highlight.props_items.wrap')],
                                ['theme', 'string', "'vibe'", __('docs/highlight.props_items.theme')],
                            ];
                        @endphp
                        @foreach ($hlProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Automated Features Table --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/highlight.features.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/highlight.features.columns.feature') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/highlight.features.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">Auto-Detect Terminal (CLI)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Otomatis mengenali awalan perintah terminal populer seperti <code class="font-mono text-xs text-foreground">php artisan</code>, <code class="font-mono text-xs text-foreground">npm</code>, <code class="font-mono text-xs text-foreground">git</code>, dan memberi judul <strong class="text-foreground">Terminal</strong> beserta ikon shell.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">Auto-Upgrade Blade</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Jika bahasa diisi <code class="font-mono text-xs text-foreground">html</code> atau kosong namun terdapat direktif <code class="font-mono text-xs text-foreground">@</code>, <code class="font-mono text-xs text-foreground">@{{ }}</code>, atau tag <code class="font-mono text-xs text-foreground">&lt;vibe:</code>, otomatis dialihkan ke highlighter Blade.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">Auto-Unindent Indentasi</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Secara otomatis memangkas spasi indentasi berlebih dari template Blade sehingga tampilan kode selalu rapi sejajar di tepi kiri.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">Normalisasi Tag Vibe</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Otomatis mengembalikan tag hasil kompilasi Blade internal <code class="font-mono text-xs text-foreground">&lt;x-vibe::component&gt;</code> menjadi sintaks kustom bersih <code class="font-mono text-xs text-foreground">&lt;vibe:component&gt;</code>.</vibe:table.cell>
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
</x-docs.layouts.sidebar>
