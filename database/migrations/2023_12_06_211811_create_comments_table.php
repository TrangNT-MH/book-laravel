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
            $table->string('book_id');
            $table->string('comment_id');
            $table->string('title');
            $table->integer('thank_count');
            $table->string('user_id');
            $table->decimal('rating', 3, 1);
            $table->text('content');
            $table->timestamps();
            $table->foreign('book_id')->references('book_id')->on('books');
            $table->foreign('user_id')->references('id')->on('users');
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
