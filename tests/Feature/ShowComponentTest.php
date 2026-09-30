<?php

use Illuminate\Support\Facades\Blade;

test('button.show renders with data-url, data-target, and default eye icon', function () {
    $html = Blade::render(
        '<vibe:button.show url="/api/users/1" target="user-detail-modal" />'
    );

    expect($html)
        ->toContain('data-url="/api/users/1"')
        ->toContain('data-target="user-detail-modal"')
        ->toContain('x-on:click.stop="vibeFetchAndShow($el)"')
        ->toContain('<svg');
});

test('button.show safely handles URLs and targets containing single quotes', function () {
    $html = Blade::render(
        "<vibe:button.show url=\"/api/search?q='foo'\" target=\"modal-'target'\" />"
    );

    expect($html)
        ->toContain('data-url="/api/search?q=&#039;foo&#039;"')
        ->toContain('data-target="modal-&#039;target&#039;"')
        ->toContain('x-on:click.stop="vibeFetchAndShow($el)"');
});

test('button.show supports custom slot content', function () {
    $html = Blade::render(
        '<vibe:button.show url="/api/users/1" target="user-detail-modal">Detail User</vibe:button.show>'
    );

    expect($html)
        ->toContain('Detail User')
        ->toContain('data-url="/api/users/1"')
        ->toContain('data-target="user-detail-modal"');
});

test('show component renders with vibe-show attribute', function () {
    $html = Blade::render(
        '<vibe:show key="user.name" class="font-bold" />'
    );

    expect($html)
        ->toContain('vibe-show="user.name"')
        ->toContain('class="font-bold"')
        ->toContain('<span');
});

test('show component supports custom tag, html, and attr options', function () {
    $html = Blade::render(
        '<vibe:show key="user.bio" as="p" html class="text-sm" />'
    );

    expect($html)
        ->toContain('<p')
        ->toContain('vibe-show="user.bio"')
        ->toContain('vibe-show-html')
        ->toContain('class="text-sm"');

    $avatarHtml = Blade::render(
        '<vibe:show key="user.avatar" as="img" attr="src" alt="Avatar" />'
    );

    expect($avatarHtml)
        ->toContain('<img')
        ->toContain('vibe-show="user.avatar"')
        ->toContain('vibe-show-attr="src"');
});

test('show.each component renders template and empty state', function () {
    $html = Blade::render(
        <<<'BLADE'
        <vibe:show.each key="user.products" as="tbody" empty="Belum ada produk." empty-colspan="3">
            <tr>
                <td vibe-show="name"></td>
                <td vibe-show="price"></td>
            </tr>
        </vibe:show.each>
        BLADE
    );

    expect($html)
        ->toContain('<tbody')
        ->toContain('vibe-show-each="user.products"')
        ->toContain('<template>')
        ->toContain('<tr')
        ->toContain('vibe-show="name"')
        ->toContain('data-vibe-empty')
        ->toContain('colspan="3"')
        ->toContain('Belum ada produk.');
});

test('show.js contains vibe:show event listener for Livewire and Alpine dispatch', function () {
    $script = file_get_contents(resource_path('js/vibe/show.js'));

    expect($script)
        ->toContain("window.addEventListener('vibe:show', handleVibeShowEvent)")
        ->toContain("window.dispatchEvent(new CustomEvent('open-modal'")
        ->toContain("window.dispatchEvent(new CustomEvent('open-sheet'")
        ->toContain('VibeShow = {')
        ->toContain('handleEvent: handleVibeShowEvent')
        ->toContain('dispatch: handleVibeShowEvent');
});

test('sheet and modal components seamlessly host vibe:show elements', function () {
    $sheetHtml = Blade::render(
        <<<'BLADE'
        <vibe:sheet id="user-sheet" position="right">
            <div>
                <vibe:show key="name" class="font-bold" />
                <vibe:show key="email" />
            </div>
        </vibe:sheet>
        BLADE
    );

    expect($sheetHtml)
        ->toContain('id="user-sheet"')
        ->toContain('@open-sheet.window')
        ->toContain('vibe-show="name"')
        ->toContain('vibe-show="email"');

    $modalHtml = Blade::render(
        <<<'BLADE'
        <vibe:modal id="user-modal">
            <div>
                <vibe:show key="user.name" class="font-semibold" />
            </div>
        </vibe:modal>
        BLADE
    );

    expect($modalHtml)
        ->toContain('vibe-modal-root')
        ->toContain('@open-modal.window')
        ->toContain('vibe-show="user.name"');
});

