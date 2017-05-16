<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsLiveCarouselTable extends Migration
{
    public function up()
    {
        Schema::create('products_live_carousel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unique();
        });
    }

    public function down()
    {
        Schema::drop('products_live_carousel');
    }
}
