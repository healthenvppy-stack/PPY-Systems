<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('business_category_id')
                ->constrained('business_categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('code', 50)->unique();
            $table->string('name');
            $table->text('description')->nullable();

            $table->string('legal_reference')->nullable();
            $table->boolean('requires_license')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            $table->index([
                'business_category_id',
                'is_active',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_types');
    }
};