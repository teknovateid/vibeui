<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

test('renders basic accordion with shorthand item title', function () {
    $template = <<<'BLADE'
        <vibe:accordion selected="faq-1">
            <vibe:accordion.item value="faq-1" title="Pertanyaan 1">
                Jawaban 1
            </vibe:accordion.item>
            <vibe:accordion.item value="faq-2" title="Pertanyaan 2">
                Jawaban 2
            </vibe:accordion.item>
        </vibe:accordion>
    BLADE;

    $html = Blade::render($template);

    expect($html)
        ->toContain('data-vibe-accordion')
        ->toContain('Pertanyaan 1')
        ->toContain('Jawaban 1')
        ->toContain('Pertanyaan 2')
        ->toContain('Jawaban 2')
        ->toContain('data-vibe-accordion-item')
        ->toContain('aria-expanded')
        ->toContain('aria-controls');
});

test('renders granular accordion with heading and content components', function () {
    $template = <<<'BLADE'
        <vibe:accordion>
            <vibe:accordion.item value="custom-1">
                <vibe:accordion.heading subtitle="Subketerangan">
                    Judul Granular
                </vibe:accordion.heading>
                <vibe:accordion.content>
                    Konten Granular
                </vibe:accordion.content>
            </vibe:accordion.item>
        </vibe:accordion>
    BLADE;

    $html = Blade::render($template);

    expect($html)
        ->toContain('Judul Granular')
        ->toContain('Subketerangan')
        ->toContain('Konten Granular')
        ->toContain('role="region"');
});

test('renders separated card variant properly', function () {
    $template = <<<'BLADE'
        <vibe:accordion variant="separated">
            <vibe:accordion.item value="card-1" title="Kartu 1">
                Isi kartu 1
            </vibe:accordion.item>
        </vibe:accordion>
    BLADE;

    $html = Blade::render($template);

    expect($html)
        ->toContain('space-y-3')
        ->toContain('rounded-xl');
});

test('renders flush variant without outer card borders', function () {
    $template = <<<'BLADE'
        <vibe:accordion variant="flush">
            <vibe:accordion.item value="f-1" title="Flush 1">
                Isi flush 1
            </vibe:accordion.item>
        </vibe:accordion>
    BLADE;

    $html = Blade::render($template);

    expect($html)
        ->toContain('divide-y')
        ->toContain('border-b');
});

test('docs accordion page returns 200 ok', function () {
    $response = $this->get(route('docs.accordion.index'));

    $response->assertStatus(200);
    $response->assertSee('Accordion');
});
