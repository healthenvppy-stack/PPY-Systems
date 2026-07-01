<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('households', function (Blueprint $table) {

            $table->id();

            $table->string('house_code',20)->unique();

            $table->string('house_no',20);

            $table->unsignedBigInteger('village_id')->nullable();

            $table->string('moo',10)->nullable();

            $table->string('road')->nullable();

            $table->string('alley')->nullable();

            $table->string('postcode',5)->nullable();

            $table->decimal('latitude',10,7)->nullable();

            $table->decimal('longitude',10,7)->nullable();

            $table->tinyInteger('flood_level')->default(0)
                ->comment('0=ไม่ท่วม,1=เขียว,2=เหลือง,3=ส้ม,4=แดง');

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->index('house_no');
            $table->index('village_id');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('households');
    }
};