<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_views', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('article_id')->constrained()->cascadeOnDelete();
            $table->string('visitor_hash', 64)->index();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('viewed_at')->useCurrent()->index();

            $table->unique(['article_id', 'visitor_hash']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_views');
    }
};
