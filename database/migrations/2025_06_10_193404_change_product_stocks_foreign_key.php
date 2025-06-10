<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
    {
        Schema::table('product_stocks', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            
            $table->foreign('product_id')
                  ->references('id')->on('products')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('product_stocks', function (Blueprint $table) {
            $table->dropForeign(['product_id']);

            $table->foreign('product_id')
                  ->references('id')->on('products')
                  ->onDelete('restrict');
        });
    }
};
