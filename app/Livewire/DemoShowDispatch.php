<?php

namespace App\Livewire;

use Livewire\Component;

class DemoShowDispatch extends Component
{
    public function dispatchToModal(): void
    {
        
        $this->dispatch('vibe:show', 
            target: 'demo-livewire-modal',
            data: [
                'name' => 'Fahril Kurniawan',
                'email' => 'fahril@teknovate.id',
                'role' => 'Staff Engineer',
                'status' => 'Aktif',
                'phone' => '+62 821-9876-5432',
                'department' => 'Core Architecture',
                'bio' => 'Building lightning-fast Blade & Livewire components for next-generation web apps.',
            ]
        );
    }

    public function dispatchToSheet(): void
    {
        $this->dispatch('vibe:show', 
            target: 'demo-livewire-sheet',
            data: [
                'name' => 'Sarah Montgomery',
                'email' => 'sarah.m@teknovate.id',
                'role' => 'Lead UI/UX Designer',
                'status' => 'Verified',
                'phone' => '+62 812-3456-7890',
                'department' => 'Product Design',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150',
                'bio' => 'Merancang interaksi desain modern dan sistem komponen Blade berkinerja tinggi.',
                'activities' => [
                    ['action' => 'Published Design System 2.0', 'time' => '10 menit yang lalu'],
                    ['action' => 'Reviewed Pull Request #42', 'time' => '1 jam yang lalu'],
                    ['action' => 'Updated Color Palette Tokens', 'time' => 'Kemarin'],
                ]
            ]
        );
    }

    public function render()
    {
        return view('livewire.demo-show-dispatch');
    }
}
