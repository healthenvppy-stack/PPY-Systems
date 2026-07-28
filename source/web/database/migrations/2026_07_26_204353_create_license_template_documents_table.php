<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('license_template_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('license_template_id')
                ->constrained('license_templates')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('code', 50);
            $table->string('name');

            $table->text('description')->nullable();

            $table->boolean('is_required')->default(true);
            $table->boolean('requires_expiry_date')->default(false);
            $table->boolean('requires_original')->default(false);

            $table->string('allowed_file_types', 255)
                ->nullable()
                ->comment('เช่น pdf,jpg,jpeg,png');

            $table->unsignedInteger('max_file_size_mb')
                ->default(10);

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
            ], 'ltd_template_active_sort_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('license_template_documents');
    }
};