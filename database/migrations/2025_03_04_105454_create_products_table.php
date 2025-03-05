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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produtc_category')->constrained('product_categories')->onDelete('cascade');
            $table->string('title', 191)->nullable();
            $table->string('slug', 191)->nullable();
            $table->boolean('active')->default(0);
            $table->boolean('promotion')->default(0);
            $table->boolean('highlight_home')->default(0);
            $table->integer('sorting')->default(0);
            $table->string('description', 191)->nullable();
            $table->string('path_image', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
