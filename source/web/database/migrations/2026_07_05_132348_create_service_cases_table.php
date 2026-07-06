<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_cases', function (Blueprint $table) {
            $table->id();

            $table->string('case_no', 30)->unique();

            $table->foreignId('citizen_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('module', 50);
            $table->string('case_type', 100);

            $table->enum('status', [
                'open',
                'assessing',
                'approved',
                'processing',
                'follow_up',
                'closed',
                'cancelled',
            ])->default('open');

            $table->enum('priority', [
                'normal',
                'urgent',
                'emergency',
            ])->default('normal');

            $table->date('opened_at')->nullable();
            $table->date('closed_at')->nullable();

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('remark')->nullable();

            $table->timestamps();

            $table->index('module');
            $table->index('case_type');
            $table->index('status');
            $table->index('priority');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_cases');
    }
};