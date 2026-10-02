<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text("content");
            $table->unsignedBigInteger("reviewer_id")->nullable();
            $table->foreign("reviewer_id")->references("id")->on("users")->onDelete("set null");
            $table->unsignedBigInteger("article_id")->nullable();
            $table->foreign("article_id")->references("id")->on("articles")->onDelete("cascade");
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
