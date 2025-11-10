<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->uuid('category_id');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->string('thumbnail')->nullable();
            $table->text('content')->nullable();
            $table->date('post_date')->nullable();
            $table->unsignedBigInteger('view')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
