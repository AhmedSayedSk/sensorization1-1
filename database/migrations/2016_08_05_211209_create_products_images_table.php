<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsImagesTable extends Migration
{
    public function up()
    {
        Schema::create('products_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->string('image_name');
        });
    }

    public function down()
    {
        Schema::drop('products_images');
    }
}
