<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeProductsTable extends Migration
{
    
    public function up()
    {
        Schema::create('type_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_name');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('type_products');
    }
}
