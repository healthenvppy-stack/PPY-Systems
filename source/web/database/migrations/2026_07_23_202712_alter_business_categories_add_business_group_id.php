<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('business_categories', function (Blueprint $table) {
            $table->foreignId('business_group_id')
                ->nullable()
                ->after('id')
                ->constrained('business_groups')
                ->nullOnDelete();
        });

        Schema::table('business_categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }

    public function down(): void
    {
        Schema::table('business_categories', function (Blueprint $table) {
            $table->foreignId('parent_id')
                ->nullable()
                ->after('name')
                ->constrained('business_categories')
                ->nullOnDelete();
        });

        Schema::table('business_categories', function (Blueprint $table) {
            $table->dropForeign(['business_group_id']);
            $table->dropColumn('business_group_id');
        });
    }
};