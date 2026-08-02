<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('cover')->nullable();
            $table->string('status', 20)->default('draft')->index(); // ArticleStatus
            $table->boolean('is_featured')->default(false)->index();
            $table->unsignedInteger('reading_time')->default(0);
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamp('archived_at')->nullable();
            $table->unsignedBigInteger('views_count')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index('author_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
