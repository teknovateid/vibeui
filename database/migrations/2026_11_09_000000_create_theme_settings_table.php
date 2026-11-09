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
        if (! Schema::hasTable('theme_settings')) {
            Schema::create('theme_settings', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique()->default('global');
                $table->json('tokens')->nullable();
                $table->longText('css')->nullable();
                $table->boolean('is_locked')->default(false);
                $table->string('updated_by')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_settings');
    }
};
