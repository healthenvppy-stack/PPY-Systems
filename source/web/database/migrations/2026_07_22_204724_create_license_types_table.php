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
        Schema::create('license_types', function (Blueprint $table) {

            $table->id();

            $table->string('code',30)->unique();

            $table->string('name');

            $table->foreignId('business_category_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->integer('valid_month')->default(12);

            $table->integer('renew_before_day')->default(30);

            $table->boolean('need_inspection')->default(true);

            $table->boolean('need_payment')->default(true);

            $table->boolean('is_active')->default(true);

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_types');
    }
};
