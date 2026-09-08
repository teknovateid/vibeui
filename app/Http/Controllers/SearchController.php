<?php

namespace App\Http\Controllers;

use App\Models\SalesMetric;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search database records for the global search modal.
     */
    public function search(Request $request): JsonResponse
    {
        $query = trim((string) $request->input('q', ''));

        if (strlen($query) < 1) {
            return response()->json([]);
        }

        $like = config('database.default') === 'pgsql' ? 'ilike' : 'like';
        $results = [];

        // 1. Search Users
        $users = User::query()
            ->where(function ($q) use ($query, $like) {
                $q->where('name', $like, "%{$query}%")
                    ->orWhere('email', $like, "%{$query}%")
                    ->orWhere('username', $like, "%{$query}%")
                    ->orWhere('position', $like, "%{$query}%");
            })
            ->limit(8)
            ->get();

        foreach ($users as $user) {
            $subtitleParts = array_filter([
                $user->email,
                $user->username ? "@{$user->username}" : null,
                $user->position,
            ]);

            $results[] = [
                'id' => 'user-' . $user->id,
                'title' => $user->name,
                'subtitle' => implode(' • ', $subtitleParts),
                'category' => 'Database',
                'subCategory' => 'Pengguna',
                'url' => route('docs.datatable.index'),
                'type' => 'database',
                'icon' => 'user',
            ];
        }

        // 2. Search Sales Metrics
        $metrics = SalesMetric::query()
            ->where(function ($q) use ($query, $like) {
                $q->where('category', $like, "%{$query}%")
                    ->orWhere('period', $like, "%{$query}%")
                    ->orWhere('month', $like, "%{$query}%")
                    ->orWhere('year', $like, "%{$query}%");
            })
            ->limit(6)
            ->get();

        foreach ($metrics as $metric) {
            $subtitle = sprintf(
                'Pendapatan: Rp %s | Pesanan: %s | Pengunjung: %s',
                number_format($metric->revenue, 0, ',', '.'),
                number_format($metric->orders_count, 0, ',', '.'),
                number_format($metric->visitors_count, 0, ',', '.')
            );

            $results[] = [
                'id' => 'metric-' . $metric->id,
                'title' => "{$metric->category} ({$metric->period})",
                'subtitle' => $subtitle,
                'category' => 'Database',
                'subCategory' => 'Metrik Penjualan',
                'url' => route('docs.chart.index'),
                'type' => 'database',
                'icon' => 'chart',
            ];
        }

        return response()->json($results);
    }
}
