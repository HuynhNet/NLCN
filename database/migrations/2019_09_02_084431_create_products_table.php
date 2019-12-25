<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_type')->nullable();
            $table->foreign('id_type')->references('id')->on('type_products');

            $table->string('name');
            $table->string('describe');
            $table->float('price');
            $table->float('promotion_price');
            $table->mediumText('image');
            $table->integer('quantity');
            $table->string('firm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
