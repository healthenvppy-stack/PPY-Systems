<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('license_template_checklists', function (Blueprint $table) {
            $table->id();

            $table->foreignId('license_template_id')
                ->constrained('license_templates')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('code', 50);
            $table->string('name');

            $table->text('description')->nullable();
            $table->text('inspection_criteria')->nullable();

            $table->enum('result_type', [
                'BOOLEAN',
                'TEXT',
                'NUMBER',
                'SCORE',
            ])->default('BOOLEAN');

            $table->decimal('maximum_score', 8, 2)->nullable();
            $table->decimal('passing_score', 8, 2)->nullable();

            $table->boolean('is_required')->default(true);
            $table->boolean('requires_photo')->default(false);
            $table->boolean('requires_note')->default(false);

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->unique([
                'license_template_id',
                'code',
            ]);

            $table->index([
                'license_template_id',
                'is_active',
                'sort_order',
            ], 'ltc_template_active_sort_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('license_template_checklists');
    }
};