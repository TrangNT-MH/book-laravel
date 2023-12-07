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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('title');
            $table->string('authors');
            $table->decimal('avg_rating', 3, 1);
            $table->integer('n_review');
            $table->decimal('price');
            $table->longText('description');
            $table->string('publisher');
            $table->string('category');
            $table->integer('page_count');
            $table->date('publish_date')->default('2023-03-05');
            $table->string('language');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
