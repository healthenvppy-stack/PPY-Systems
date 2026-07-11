<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('welfare_benefits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('citizen_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('benefit_type_id')
                ->constrained('benefit_types')
                ->restrictOnDelete();

            $table->enum('status', [
                'pending',
                'approved',
                'receiving',
                'suspended',
                'stopped',
                'cancelled',
            ])->default('pending');

            $table->decimal('amount', 12, 2)->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->string('agency', 150)->nullable();
            $table->string('reference_no', 100)->nullable();

            $table->text('remark')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['citizen_id', 'status']);
            $table->index(['benefit_type_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('welfare_benefits');
    }
};