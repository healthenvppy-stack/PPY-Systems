<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('health_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('citizen_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->boolean('has_chronic_disease')->default(false);
            $table->boolean('has_diabetes')->default(false);
            $table->boolean('has_hypertension')->default(false);
            $table->boolean('has_heart_disease')->default(false);
            $table->boolean('has_kidney_disease')->default(false);

            $table->boolean('is_bedridden')->default(false);
            $table->boolean('is_homebound')->default(false);
            $table->boolean('is_disabled')->default(false);
            $table->boolean('is_elderly')->default(false);

            $table->enum('health_level', [
                'green',
                'yellow',
                'orange',
                'red'
            ])->default('green');

            $table->date('last_home_visit_at')->nullable();

            $table->text('remark')->nullable();

            $table->timestamps();

            $table->unique('citizen_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_profiles');
    }
};
