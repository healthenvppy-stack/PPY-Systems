<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('business_types', 'license_fee')) {
            Schema::table('business_types', function (Blueprint $table) {
                $table->decimal('license_fee', 10, 2)
                    ->default(0)
                    ->after('requires_license');
            });
        }

        if (! Schema::hasColumn('business_types', 'license_validity_months')) {
            Schema::table('business_types', function (Blueprint $table) {
                $table->unsignedInteger('license_validity_months')
                    ->default(12)
                    ->after('license_fee');
            });
        }

        if (! Schema::hasColumn('business_types', 'inspection_interval_months')) {
            Schema::table('business_types', function (Blueprint $table) {
                $table->unsignedInteger('inspection_interval_months')
                    ->nullable()
                    ->after('license_validity_months');
            });
        }

        if (! Schema::hasColumn('business_types', 'risk_level')) {
            Schema::table('business_types', function (Blueprint $table) {
                $table->enum('risk_level', [
                    'ต่ำ',
                    'ปานกลาง',
                    'สูง',
                ])
                    ->default('ปานกลาง')
                    ->after('inspection_interval_months');
            });
        }

        if (! Schema::hasColumn('business_types', 'application_form')) {
            Schema::table('business_types', function (Blueprint $table) {
                $table->string('application_form')
                    ->nullable()
                    ->after('risk_level');
            });
        }
    }

    public function down(): void
    {
        $columns = [
            'license_fee',
            'license_validity_months',
            'inspection_interval_months',
            'risk_level',
            'application_form',
        ];

        foreach ($columns as $column) {
            if (Schema::hasColumn('business_types', $column)) {
                Schema::table('business_types', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};