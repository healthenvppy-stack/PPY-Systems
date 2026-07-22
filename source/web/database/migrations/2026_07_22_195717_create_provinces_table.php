<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();

            // รหัสจังหวัดตามมาตรฐานราชการ เช่น 72 = สุพรรณบุรี
            $table->string('code', 2)->unique();

            $table->string('name_th', 100);
            $table->string('name_en', 100)->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index('name_th');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};