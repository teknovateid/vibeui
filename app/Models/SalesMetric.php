<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesMetric extends Model
{
    /** @use HasFactory<\Database\Factories\SalesMetricFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'year' => 'integer',
        'revenue' => 'float',
        'expenses' => 'float',
        'profit' => 'float',
        'orders_count' => 'integer',
        'visitors_count' => 'integer',
        'conversion_rate' => 'float',
    ];
}
