<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->nullable()->comment('Equipment category name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('capacity')->nullable();
            $table->string('unit')->nullable();
            $table->string('name_en')->nullable();
            $table->text('description_en')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('slug');
            $table->index('category');
            $table->index('is_featured');
            $table->index('is_active');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
