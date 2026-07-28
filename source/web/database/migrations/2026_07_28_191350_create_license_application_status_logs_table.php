<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('license_application_status_logs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('license_application_id');

            $table->foreign('license_application_id', 'lasl_application_fk')
                ->references('id')
                ->on('license_applications')
                ->cascadeOnDelete();

            //$table->foreignId('license_application_id')
            //    ->constrained('license_applications')
            //    ->cascadeOnDelete();

            $table->string('from_status', 50)->nullable();
            $table->string('to_status', 50);

            $table->text('note')->nullable();

            $table->foreignId('changed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('changed_at');
            $table->timestamps();

            //$table->index([
            //    'license_application_id',
            //    'changed_at',
            //]);
            $table->index(
                ['license_application_id', 'changed_at'],
                'lasl_application_changed_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('license_application_status_logs');
    }
};