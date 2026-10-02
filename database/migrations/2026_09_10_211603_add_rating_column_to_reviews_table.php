<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->decimal("rating",2,1)->check("rating>=0 AND rating <=5");
        });
    }

    
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn("rating");
        });
    }
};
