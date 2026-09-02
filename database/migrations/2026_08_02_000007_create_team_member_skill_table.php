<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_member_skill', function (Blueprint $table) {
            $table->foreignUuid('team_member_id')->constrained('team_members')->cascadeOnDelete();
            $table->foreignUuid('skill_id')->constrained('skills')->cascadeOnDelete();
            $table->primary(['team_member_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_member_skill');
    }
};
