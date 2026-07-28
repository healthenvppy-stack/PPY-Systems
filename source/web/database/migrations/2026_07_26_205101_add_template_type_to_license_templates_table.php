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
        Schema::table('license_templates', function (Blueprint $table) {

            $table->enum('template_type', [
                'NEW',
                'RENEW',
                'CHANGE',
                'REPLACE',
                'CANCEL',
            ])->default('NEW')->after('name');

            $table->boolean('is_default')
                ->default(false)
                ->after('template_type');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('license_templates', function (Blueprint $table) {

            $table->dropColumn([
                'template_type',
                'is_default',
            ]);

        });
    }
};
