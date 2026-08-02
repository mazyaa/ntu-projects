<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('group')->default('general')->index();
            $table->string('key')->index();
            $table->text('value')->nullable();
            $table->string('type')->default('string'); // string|boolean|integer|json
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['group', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
