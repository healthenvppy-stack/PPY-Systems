<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('welfare_profiles', function (Blueprint $table) {

            $table->boolean('receives_elderly_allowance')
                  ->default(false)
                  ->after('is_elderly');

            $table->enum('elderly_allowance_status',[
                'not_registered',
                'pending',
                'receiving',
                'suspended',
                'cancelled'
            ])
            ->default('not_registered')
            ->after('receives_elderly_allowance');

            $table->date('elderly_allowance_started_at')
                  ->nullable()
                  ->after('elderly_allowance_status');

            $table->text('elderly_allowance_remark')
                  ->nullable()
                  ->after('elderly_allowance_started_at');

        });
    }

    public function down(): void
    {
        Schema::table('welfare_profiles', function (Blueprint $table) {

            $table->dropColumn([
                'receives_elderly_allowance',
                'elderly_allowance_status',
                'elderly_allowance_started_at',
                'elderly_allowance_remark'
            ]);

        });
    }
};