<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_case_timelines', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_case_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('action', 100);

            $table->text('description')->nullable();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->dateTime('action_at')->nullable();

            $table->timestamps();

            $table->index('action');
            $table->index('action_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_case_timelines');
    }
};