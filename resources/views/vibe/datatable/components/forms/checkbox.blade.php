@aware(['tableName', 'primaryKey', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5'])
@props(['checkboxAttributes'])
<input
    x-cloak
    {{
        $attributes->merge($checkboxAttributes)->class([
            'h-4 w-4 rounded border-border text-primary focus:ring-primary bg-background transition-colors cursor-pointer shadow-2xs' => ($checkboxAttributes['default'] ?? true),
        ])->except(['default', 'default-styling', 'default-colors'])
    }}
/>
