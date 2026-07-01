<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citizens', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('household_id')->nullable();

            $table->string('cid',13)->unique();

            $table->unsignedBigInteger('title_id')->nullable();

            $table->string('first_name',100);

            $table->string('last_name',100)->nullable();

            $table->enum('gender',['ชาย','หญิง']);

            $table->date('birth_date')->nullable();

            $table->unsignedBigInteger('religion_id')->nullable();

            $table->unsignedBigInteger('nationality_id')->nullable();

            $table->unsignedBigInteger('occupation_id')->nullable();

            $table->unsignedBigInteger('education_level_id')->nullable();

            $table->string('phone',20)->nullable();

            $table->string('email')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->index('cid');
            $table->index('household_id');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citizens');
    }
};
