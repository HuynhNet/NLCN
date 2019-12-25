<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_product')->nullable();
            $table->foreign('id_product')->references('id')
                ->on('products');

            $table->unsignedBigInteger('id_bill')->nullable();
            $table->foreign('id_bill')->references('id')
                ->on('bills');

            $table->integer('quantity');
            $table->float('price');
            
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
        Schema::dropIfExists('bill_details');
    }
}
