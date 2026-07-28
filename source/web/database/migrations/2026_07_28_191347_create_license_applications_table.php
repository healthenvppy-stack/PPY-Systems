<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('license_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('business_id')
                ->constrained('businesses')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('business_type_id')
                ->nullable()
                ->constrained('business_types')
                ->nullOnDelete();

            $table->foreignId('license_template_id')
                ->nullable()
                ->constrained('license_templates')
                ->nullOnDelete();

            $table->foreignId('applicant_citizen_id')
                ->nullable()
                ->constrained('citizens')
                ->nullOnDelete();

            $table->string('application_no', 50)->unique();

            $table->enum('application_type', [
                'new',
                'renew',
                'change',
                'transfer',
            ])->default('new');

            $table->date('application_date');

            $table->date('requested_start_date')->nullable();

            $table->enum('status', [
                'draft',
                'submitted',
                'document_review',
                'document_incomplete',
                'inspection_pending',
                'inspection_completed',
                'under_consideration',
                'approved',
                'rejected',
                'cancelled',
                'license_issued',
            ])->default('draft');

            $table->string('contact_name')->nullable();
            $table->string('contact_phone', 30)->nullable();
            $table->string('contact_email')->nullable();

            $table->decimal('application_fee', 12, 2)->default(0);
            $table->decimal('license_fee', 12, 2)->default(0);
            $table->decimal('total_fee', 12, 2)->default(0);

            $table->text('applicant_note')->nullable();
            $table->text('officer_note')->nullable();
            $table->text('rejection_reason')->nullable();

            $table->foreignId('submitted_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('submitted_at')->nullable();

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('reviewed_at')->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'business_id',
                'status',
            ]);

            $table->index([
                'application_date',
                'application_type',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('license_applications');
    }
};