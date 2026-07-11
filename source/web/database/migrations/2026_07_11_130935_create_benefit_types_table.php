<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('benefit_types', function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique();
            $table->string('name_th', 150);
            $table->string('name_en', 150)->nullable();

            $table->string('category', 100)->nullable();

            $table->boolean('is_active')->default(true);

            $table->text('remark')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('benefit_types');
    }
};
