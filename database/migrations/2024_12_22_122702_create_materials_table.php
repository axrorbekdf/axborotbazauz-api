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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('downloads')->nullable()->default(0);
            $table->foreignId('category_id')->nullable();
            $table->foreignId('subject_id')->nullable();
            $table->string('path')->nullable();
            $table->string('size')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable()->default('passive'); // active, passive
            $table->string('responsible_worker')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
