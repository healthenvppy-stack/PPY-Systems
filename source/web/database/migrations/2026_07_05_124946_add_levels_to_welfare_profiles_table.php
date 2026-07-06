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
        Schema::table('welfare_profiles', function (Blueprint $table) {
            
            $table->enum('care_level', [
                'normal',
                'watch',
                'home_visit',
                'homebound',
                'bedridden'
            ])->default('normal');

            $table->enum('risk_level', [
                'low',
                'medium',
                'high',
                'critical'
            ])->default('low');

            $table->enum('priority_level', [
                'normal',
                'urgent',
                'emergency'
            ])->default('normal');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('welfare_profiles', function (Blueprint $table) {
            //
        });
    }
};
