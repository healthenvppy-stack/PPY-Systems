<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('license_application_documents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('license_application_id');

            $table->foreign('license_application_id', 'lad_application_fk')
                ->references('id')
                ->on('license_applications')
                ->cascadeOnDelete();

            //$table->foreignId('license_application_id')
            //    ->constrained('license_applications')
            //    ->cascadeOnDelete();

            //$table->foreignId('license_template_document_id')
            //    ->nullable()
            //    ->constrained('license_template_documents')
            //    ->nullOnDelete();

            $table->unsignedBigInteger('license_template_document_id')->nullable();

            $table->foreign('license_template_document_id', 'lad_template_doc_fk')
                ->references('id')
                ->on('license_template_documents')
                ->nullOnDelete();

            $table->string('document_name');
            $table->string('file_path')->nullable();
            $table->string('original_name')->nullable();
            $table->string('mime_type', 100)->nullable();
            $table->unsignedBigInteger('file_size')->nullable();

            $table->boolean('is_required')->default(false);
            $table->boolean('is_submitted')->default(false);
            $table->boolean('is_verified')->default(false);

            $table->text('verification_note')->nullable();

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('verified_at')->nullable();

            $table->timestamps();

            //$table->index([
            //    'license_application_id',
            //    'is_verified',
            //]);
            $table->index(
                ['license_application_id', 'is_verified'],
                'lad_application_verified_idx'
                    );

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('license_application_documents');
    }
};