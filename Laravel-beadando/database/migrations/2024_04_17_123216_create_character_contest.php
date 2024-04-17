<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('character_contest', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contest_id')->constrained('contests')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('character_id')->constrained('characters')->onDelete('cascade')->onUpdate('cascade');
            $table->float('hero_hp')->min(0)->max(20)->default(20);
            $table->float('enemy_hp')->min(0)->max(20)->default(20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_contest');
    }
};
