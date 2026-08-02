<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('slug_en')->nullable()->unique()->after('slug');
            $table->text('excerpt_en')->nullable()->after('excerpt');
            $table->longText('content_en')->nullable()->after('content');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('slug_en')->nullable()->unique()->after('slug');
            $table->string('title_en')->nullable()->after('title');
            $table->string('short_title_en')->nullable()->after('short_title');
            $table->string('tagline_en')->nullable()->after('tagline');
            $table->text('description_en')->nullable()->after('description');
            $table->json('service_items_en')->nullable()->after('service_items');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->text('skills_en')->nullable()->after('skills');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'slug_en', 'excerpt_en', 'content_en']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['slug_en', 'title_en', 'short_title_en', 'tagline_en', 'description_en', 'service_items_en']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['skills_en']);
        });
    }
};
