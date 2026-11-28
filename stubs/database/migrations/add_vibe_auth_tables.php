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
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (! Schema::hasColumn('users', 'phone')) {
                    $table->string('phone')->nullable()->unique()->after('email');
                }
                if (! Schema::hasColumn('users', 'username')) {
                    $table->string('username')->nullable()->unique()->after('phone');
                }
                if (! Schema::hasColumn('users', 'avatar')) {
                    $table->string('avatar')->nullable()->after('username');
                }
            });
        }

        if (! Schema::hasTable('two_factor_authenticators')) {
            Schema::create('two_factor_authenticators', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('method');
                $table->text('secret')->nullable();
                $table->text('recovery_codes')->nullable();
                $table->boolean('is_default')->default(false);
                $table->timestamp('confirmed_at')->nullable();
                $table->timestamp('last_used_at')->nullable();
                $table->timestamps();

                $table->unique(['user_id', 'method']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('two_factor_authenticators');

        if (Schema::hasTable('users')) {
            $hasPhone = Schema::hasColumn('users', 'phone');
            $hasUsername = Schema::hasColumn('users', 'username');
            $hasAvatar = Schema::hasColumn('users', 'avatar');
            $hasPhoneUnique = $hasPhone && Schema::hasIndex('users', ['phone'], 'unique');
            $hasUsernameUnique = $hasUsername && Schema::hasIndex('users', ['username'], 'unique');

            Schema::table('users', function (Blueprint $table) use (
                $hasPhone,
                $hasUsername,
                $hasAvatar,
                $hasPhoneUnique,
                $hasUsernameUnique,
            ) {
                if ($hasPhoneUnique) {
                    $table->dropUnique(['phone']);
                }
                if ($hasUsernameUnique) {
                    $table->dropUnique(['username']);
                }

                $columns = array_values(array_filter([
                    $hasPhone ? 'phone' : null,
                    $hasUsername ? 'username' : null,
                    $hasAvatar ? 'avatar' : null,
                ]));

                if ($columns !== []) {
                    $table->dropColumn($columns);
                }
            });
        }
    }
};
