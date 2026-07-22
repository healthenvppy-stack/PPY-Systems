<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subdistricts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('district_id')
                ->constrained('districts')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // รหัสตำบล 6 หลัก เช่น 720101
            $table->string('code', 6)->unique();

            $table->string('name_th', 100);
            $table->string('name_en', 100)->nullable();

            $table->string('postal_code', 5)->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['district_id', 'name_th']);
            $table->index(['district_id', 'is_active']);
            $table->index('postal_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subdistricts');
    }
};