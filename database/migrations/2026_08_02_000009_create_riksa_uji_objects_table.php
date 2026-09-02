<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riksa_uji_objects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('company_id')->nullable()->constrained('companies')->nullOnDelete();
            $table->foreignUuid('category_id')->nullable()->constrained('riksa_uji_categories')->nullOnDelete();
            $table->foreignUuid('type_id')->nullable()->constrained('riksa_uji_types')->nullOnDelete();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('factory_number')->nullable();
            $table->string('manufacture_year', 4)->nullable();
            $table->string('capacity')->nullable();
            $table->string('capacity_unit')->nullable();
            $table->timestamps();

            $table->index('company_id');
            $table->index('category_id');
            $table->index('type_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riksa_uji_objects');
    }
};
