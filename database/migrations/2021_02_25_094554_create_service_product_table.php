<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_product', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('product_id')->unsigned();
            $table->BigInteger('service_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('service_id')->references('id')->on('service');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_product');
    }
}
