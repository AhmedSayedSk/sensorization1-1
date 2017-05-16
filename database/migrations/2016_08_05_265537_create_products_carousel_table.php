<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsCarouselTable extends Migration
{
    public function up()
    {
        Schema::create('products_carousel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->string('carousel_name');
        });
    }

    public function down()
    {
        Schema::drop('products_carousel');
    }
}
