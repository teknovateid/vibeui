<?php

namespace Database\Factories;

use App\Models\SalesMetric;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SalesMetric>
 */
class SalesMetricFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $categories = ['Elektronik', 'Fashion', 'Makanan', 'Kesehatan', 'Otomotif'];

        $month = fake()->randomElement($months);
        $year = 2026;
        $revenue = fake()->numberBetween(35, 140) * 1000000;
        $expenses = $revenue * fake()->randomFloat(2, 0.4, 0.68);
        $profit = $revenue - $expenses;
        $visitors = fake()->numberBetween(3500, 18000);
        $orders = fake()->numberBetween(220, 1200);

        return [
            'period' => "{$month} {$year}",
            'month' => $month,
            'year' => $year,
            'category' => fake()->randomElement($categories),
            'revenue' => $revenue,
            'expenses' => round($expenses, 2),
            'profit' => round($profit, 2),
            'orders_count' => $orders,
            'visitors_count' => $visitors,
            'conversion_rate' => round(($orders / $visitors) * 100, 2),
        ];
    }
}
