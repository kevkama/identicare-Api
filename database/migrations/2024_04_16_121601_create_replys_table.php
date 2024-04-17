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
        Schema::create('replys', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('media')->nullable();
            $table->unsignedBigInteger('like');
            $table->foreign('like')->nullable()->references('id')->on('likes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replys');
    }
};
