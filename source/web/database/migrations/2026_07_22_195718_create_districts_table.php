<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('province_id')
                ->constrained('provinces')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // รหัสอำเภอ 4 หลัก เช่น 7201
            $table->string('code', 4)->unique();

            $table->string('name_th', 100);
            $table->string('name_en', 100)->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['province_id', 'name_th']);
            $table->index(['province_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
