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
        Schema::create('match_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sport_id')->constrained();
            $table->string('title');
            $table->enum('status', ['scheduled', 'ongoing', 'finished'])->default('scheduled');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_records');
    }
};
