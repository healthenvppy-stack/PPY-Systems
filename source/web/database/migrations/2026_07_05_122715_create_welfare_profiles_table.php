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
        Schema::create('welfare_profiles', function (Blueprint $table) {

            $table->id();

            $table->foreignId('citizen_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->boolean('is_elderly')->default(false);

            $table->boolean('is_disabled')->default(false);

            $table->boolean('is_low_income')->default(false);

            $table->boolean('is_vulnerable')->default(false);

            $table->boolean('is_bedridden')->default(false);

            $table->boolean('is_homebound')->default(false);

            $table->text('remark')->nullable();

            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welfare_profiles');
    }
};
