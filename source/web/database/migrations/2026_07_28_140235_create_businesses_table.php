<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('business_type_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('code', 30)->unique();
            $table->string('name', 255);

            $table->string('owner_prefix', 50)->nullable();
            $table->string('owner_first_name', 150);
            $table->string('owner_last_name', 150);
            $table->string('owner_citizen_id', 13)->nullable()->index();

            $table->string('phone', 20)->nullable();
            $table->string('email', 150)->nullable();

            $table->string('house_no', 50)->nullable();
            $table->string('moo', 20)->nullable();
            $table->string('soi', 100)->nullable();
            $table->string('road', 100)->nullable();

            $table->string('subdistrict', 150)->nullable();
            $table->string('district', 150)->nullable();
            $table->string('province', 150)->nullable();
            $table->string('postal_code', 10)->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->text('description')->nullable();
            $table->text('remark')->nullable();

            $table->enum('status', [
                'active',
                'inactive',
                'closed',
            ])->default('active');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['business_type_id', 'status']);
            $table->index(['name', 'owner_first_name', 'owner_last_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};