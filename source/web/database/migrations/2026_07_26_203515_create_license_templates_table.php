<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('license_templates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('business_type_id')
                ->constrained('business_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('code', 50)->unique();
            $table->string('name');

            $table->string('application_form')->nullable();
            $table->decimal('fee_amount', 10, 2)->default(0);
            $table->unsignedInteger('validity_months')->default(12);
            $table->unsignedInteger('inspection_interval_months')->nullable();

            $table->string('approval_authority')->nullable();
            $table->text('legal_reference')->nullable();
            $table->text('description')->nullable();

            $table->date('effective_date')->nullable();
            $table->date('expiry_date')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('version')->default(1);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index([
                'business_type_id',
                'is_active',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('license_templates');
    }
};