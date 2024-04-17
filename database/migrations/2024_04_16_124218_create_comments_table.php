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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('profiles');
            $table->string('content');
            $table->string('media')->nullable();
            $table->unsignedBigInteger('like');
            $table->foreign('like')->nullable()->references('id')->on('likes');
            $table->unsignedBigInteger('reply');
            $table->foreign('reply')->nullable()->references('id')->on('replys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
