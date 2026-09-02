<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Add new columns for PHASE 2 structure
            $table->text('short_description')->nullable()->after('tagline');
            $table->text('short_description_en')->nullable()->after('tagline_en');
            $table->boolean('is_featured')->default(false)->after('status');
            $table->boolean('is_active')->default(true)->after('is_featured');

            // Rename existing columns to match PHASE 2 naming
            // Note: 'title' stays as 'title' (maps to 'name' in spec)
            // Note: 'image' stays as 'image' (maps to 'featured_image' in spec)
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'short_description',
                'short_description_en',
                'is_featured',
                'is_active',
            ]);
        });
    }
};
