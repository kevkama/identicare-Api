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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('profiles');
            $table->string('content');
            $table->string('image')->nullable();
            $table->string('likes')->nullable();
            $table->unsignedBigInteger('comments');
            $table->foreign('comments')->nullable()->references('id')->on('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
