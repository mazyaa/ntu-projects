<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspection_request_objects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('inspection_request_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('riksa_uji_object_id')->nullable()->constrained('riksa_uji_objects')->nullOnDelete();

            // Object snapshot (in case object is created ad-hoc for the request)
            $table->string('object_name');
            $table->foreignUuid('category_id')->nullable()->constrained('riksa_uji_categories')->nullOnDelete();
            $table->foreignUuid('type_id')->nullable()->constrained('riksa_uji_types')->nullOnDelete();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('factory_number')->nullable();
            $table->string('manufacture_year', 4)->nullable();
            $table->string('capacity')->nullable();
            $table->string('capacity_unit')->nullable();

            // Previous inspection per-object
            $table->boolean('has_previous_inspection')->nullable();
            $table->string('previous_certificate_number')->nullable();
            $table->date('previous_inspection_date')->nullable();
            $table->date('certificate_expiry_date')->nullable();
            $table->string('previous_pjk3')->nullable();

            $table->timestamps();

            $table->index('inspection_request_id');
            $table->index('riksa_uji_object_id');
            $table->index('category_id');
            $table->index('type_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_request_objects');
    }
};
