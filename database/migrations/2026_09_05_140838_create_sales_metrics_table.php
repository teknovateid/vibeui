<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('period')->index();
            $table->string('month');
            $table->integer('year')->default(2026);
            $table->string('category')->index();
            $table->decimal('revenue', 15, 2)->default(0);
            $table->decimal('expenses', 15, 2)->default(0);
            $table->decimal('profit', 15, 2)->default(0);
            $table->integer('orders_count')->default(0);
            $table->integer('visitors_count')->default(0);
            $table->decimal('conversion_rate', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_metrics');
    }
};
