<?php

namespace Database\Seeders;

use App\Models\SalesMetric;
use Illuminate\Database\Seeder;

class SalesMetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesMetric::truncate();

        // 1. Monthly Records (Jan - Des 2026)
        $monthly = [
            ['month' => 'Jan', 'revenue' => 45000000,  'expenses' => 22000000, 'orders' => 380, 'visitors' => 4200],
            ['month' => 'Feb', 'revenue' => 52000000,  'expenses' => 25000000, 'orders' => 420, 'visitors' => 4900],
            ['month' => 'Mar', 'revenue' => 61000000,  'expenses' => 28000000, 'orders' => 510, 'visitors' => 5600],
            ['month' => 'Apr', 'revenue' => 58000000,  'expenses' => 27000000, 'orders' => 490, 'visitors' => 5400],
            ['month' => 'Mei', 'revenue' => 74000000,  'expenses' => 32000000, 'orders' => 620, 'visitors' => 6800],
            ['month' => 'Jun', 'revenue' => 88000000,  'expenses' => 38000000, 'orders' => 740, 'visitors' => 8100],
            ['month' => 'Jul', 'revenue' => 95000000,  'expenses' => 41000000, 'orders' => 810, 'visitors' => 8900],
            ['month' => 'Agu', 'revenue' => 112000000, 'expenses' => 46000000, 'orders' => 940, 'visitors' => 10200],
            ['month' => 'Sep', 'revenue' => 105000000, 'expenses' => 44000000, 'orders' => 880, 'visitors' => 9700],
            ['month' => 'Okt', 'revenue' => 124000000, 'expenses' => 49000000, 'orders' => 1050, 'visitors' => 11500],
            ['month' => 'Nov', 'revenue' => 138000000, 'expenses' => 55000000, 'orders' => 1180, 'visitors' => 13100],
            ['month' => 'Des', 'revenue' => 156000000, 'expenses' => 61000000, 'orders' => 1340, 'visitors' => 15000],
        ];

        foreach ($monthly as $item) {
            $profit = $item['revenue'] - $item['expenses'];
            $conversion = round(($item['orders'] / $item['visitors']) * 100, 2);

            SalesMetric::create([
                'period' => $item['month'] . ' 2026',
                'month' => $item['month'],
                'year' => 2026,
                'category' => 'Semua Kategori',
                'revenue' => $item['revenue'],
                'expenses' => $item['expenses'],
                'profit' => $profit,
                'orders_count' => $item['orders'],
                'visitors_count' => $item['visitors'],
                'conversion_rate' => $conversion,
            ]);
        }

        // 2. Category Records for Donut / Bar comparison
        $categories = [
            ['category' => 'Elektronik & Gadget', 'revenue' => 385000000, 'orders' => 2450],
            ['category' => 'Fashion & Busana',    'revenue' => 275000000, 'orders' => 3120],
            ['category' => 'Makanan & Minuman',   'revenue' => 195000000, 'orders' => 4150],
            ['category' => 'Kesehatan & Kecantikan', 'revenue' => 145000000, 'orders' => 1890],
            ['category' => 'Otomotif & Hobi',     'revenue' => 88000000,  'orders' => 740],
        ];

        foreach ($categories as $cat) {
            SalesMetric::create([
                'period' => 'Tahun 2026',
                'month' => 'Total',
                'year' => 2026,
                'category' => $cat['category'],
                'revenue' => $cat['revenue'],
                'expenses' => $cat['revenue'] * 0.45,
                'profit' => $cat['revenue'] * 0.55,
                'orders_count' => $cat['orders'],
                'visitors_count' => $cat['orders'] * 12,
                'conversion_rate' => 8.33,
            ]);
        }
    }
}
