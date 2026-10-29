<?php

namespace App\Livewire;

use Livewire\Component;

class DemoTodo extends Component
{
    public array $tasks = [];
    public string $newTaskTitle = '';

    public function mount(): void
    {
        $this->tasks = [
            [
                'id' => '1',
                'title' => 'Riset implementasi CSS Container Queries di Vibe UI',
                'description' => 'Eksplorasi utilitas container query Tailwind v4 untuk komponen responsif.',
                'completed' => false,
                'badge' => 'High',
                'badgeVariant' => 'destructive',
                'dueDate' => 'Hari Ini',
                'group' => 'todo',
                'order' => 0,
            ],
            [
                'id' => '2',
                'title' => 'Integrasi Drag & Drop Touch Event pada Todo Component',
                'description' => 'Mendukung perangkat layar sentuh iOS/Android dengan pointer event fallback.',
                'completed' => false,
                'badge' => 'Design',
                'badgeVariant' => 'primary',
                'dueDate' => 'Kemarin',
                'group' => 'progress',
                'order' => 1,
            ],
            [
                'id' => '3',
                'title' => 'Review Anti-FOUC Blueprint & Cumulative Layout Shift (CLS)',
                'description' => 'Pastikan rendering server-side tanpa kedip saat refresh atau hot reload.',
                'completed' => true,
                'badge' => 'Core',
                'badgeVariant' => 'warning',
                'dueDate' => 'Selesai',
                'group' => 'done',
                'order' => 2,
            ],
            [
                'id' => '4',
                'title' => 'Selesaikan dokumentasi komponen dan unit tests',
                'description' => 'Buat halaman dokumentasi interaktif dengan contoh Livewire, API, dan Form submit.',
                'completed' => false,
                'badge' => 'Docs',
                'badgeVariant' => 'outline',
                'dueDate' => '28 Okt',
                'group' => 'todo',
                'order' => 3,
            ],
        ];
    }

    public function updateTaskOrder(array $orderedIds, ?string $changedItemId = null, ?string $fromGroup = null, ?string $toGroup = null): void
    {
        $idMap = array_flip($orderedIds);
        
        usort($this->tasks, function ($a, $b) use ($idMap) {
            $orderA = $idMap[$a['id']] ?? 999;
            $orderB = $idMap[$b['id']] ?? 999;
            return $orderA <=> $orderB;
        });

        foreach ($this->tasks as $index => &$task) {
            $task['order'] = $index;
            if ($changedItemId && $toGroup && $task['id'] === $changedItemId) {
                $task['group'] = $toGroup;
            }
        }
    }

    public function toggleTask(string $id): void
    {
        foreach ($this->tasks as &$task) {
            if ($task['id'] === $id) {
                $task['completed'] = ! $task['completed'];
                break;
            }
        }
    }

    public function updateTask(string $id, string $title, ?string $description = null): void
    {
        foreach ($this->tasks as &$task) {
            if ($task['id'] === $id) {
                $task['title'] = trim($title);
                if ($description !== null) {
                    $task['description'] = trim($description);
                }
                break;
            }
        }
    }

    public function deleteTask(string $id): void
    {
        $this->tasks = array_values(array_filter($this->tasks, fn ($t) => $t['id'] !== $id));
    }

    public function addTask(string $title, ?string $group = null): void
    {
        $clean = trim($title);
        if (empty($clean)) return;

        $newId = (string) (count($this->tasks) + 1 + time());
        $this->tasks[] = [
            'id' => $newId,
            'title' => $clean,
            'description' => null,
            'completed' => false,
            'badge' => 'New',
            'badgeVariant' => 'primary',
            'dueDate' => 'Hari Ini',
            'group' => $group ?: 'todo',
            'order' => count($this->tasks),
        ];

        $this->newTaskTitle = '';
    }

    public function render()
    {
        return view('livewire.demo-todo');
    }
}
