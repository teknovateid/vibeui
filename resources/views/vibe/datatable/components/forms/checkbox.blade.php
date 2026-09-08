@aware(['tableName', 'primaryKey', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5'])
@props(['checkboxAttributes' => []])

@php
    $attributes = $attributes->merge($checkboxAttributes ?? [])->except(['default', 'default-styling', 'default-colors']);
@endphp

<vibe:checkbox {{ $attributes }} />


