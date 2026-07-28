<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->foreignId('citizen_id')
                ->nullable()
                ->after('business_type_id')
                ->constrained('citizens')
                ->nullOnDelete();

            //$table->index('owner_citizen_id');
        });
    }

    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropForeign(['citizen_id']);
            //$table->dropIndex(['owner_citizen_id']);
            $table->dropColumn('citizen_id');
        });
    }
};
