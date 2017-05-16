<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {
    
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serial_number');
            $table->string('name');
            $table->string('description');

            $table->float('price');
            $table->integer('discount_percentage');

            $table->integer('category_table_number');
            $table->integer('category_id');

            $table->boolean('is_amount_unlimited')->default(0);
            $table->string('amount')->nullable();

            $table->integer('sales')->default(0);
            $table->integer('view_counter')->default(0);
            $table->float('stars');

            $table->string('start_at');
            $table->boolean('is_forever')->default(0);
            $table->string('expires_at')->nullable();

            $table->boolean('is_payment_on_delivery')->default(0);
            $table->boolean('is_payment_by_paypal')->default(0);

            $table->boolean('is_real')->default(0);
            $table->boolean('is_live')->default(0);

            $table->boolean('is_new')->default(0);
            $table->string('new_status_time')->nullable(); // related by `is_new` coulmn: to control for on/off status

            $table->integer('primary_image_id')->nullable();
            $table->integer('primary_carousel_id')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('products');
    }
}
