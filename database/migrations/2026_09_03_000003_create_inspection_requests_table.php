<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspection_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('request_number')->unique();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('company_id')->nullable()->constrained('companies')->nullOnDelete();
            $table->string('status')->default('new')->index();

            // Applicant snapshot
            $table->string('applicant_name');
            $table->string('applicant_position')->nullable();
            $table->string('applicant_phone');
            $table->string('applicant_email');

            // Inspection location
            $table->text('inspection_address')->nullable();
            $table->string('inspection_province')->nullable();
            $table->string('inspection_city')->nullable();
            $table->string('inspection_district')->nullable();
            $table->string('inspection_postal_code', 10)->nullable();
            $table->text('location_notes')->nullable();

            // Customer notes
            $table->text('customer_notes')->nullable();

            // Previous inspection summary (for the request as a whole)
            $table->boolean('has_previous_inspection')->nullable();
            $table->string('previous_certificate_number')->nullable();
            $table->date('previous_inspection_date')->nullable();
            $table->date('certificate_expiry_date')->nullable();
            $table->string('previous_pjk3')->nullable();

            // Documents (polymorphic — reuse documentable)
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->index('company_id');
            $table->index('submitted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_requests');
    }
};
