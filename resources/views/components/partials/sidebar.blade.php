<aside class="w-64 bg-white border-r border-gray-200 shrink-0">
    <!-- Isi menu sidebar statismu di sini -->
    <div class="p-4 font-bold text-gray-800 border-b">
        Teknovate App
    </div>
    <nav class="p-4 space-y-2">
        <a href="/{{ request()->segment(1) }}" wire:navigate class="block text-gray-600 hover:text-blue-600">Index</a>
        <a href="/{{ request()->segment(1) }}/blank" wire:navigate class="block text-gray-600 hover:text-blue-600">Blank</a>
        <a href="#" wire:navigate class="block text-gray-600 hover:text-blue-600">Resource</a>
    </nav>
</aside>
