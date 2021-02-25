<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvantageProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advantage_product', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('product_id')->unsigned();
            $table->BigInteger('advantage_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('advantage_id')->references('id')->on('advantage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advantage_product');
    }
}
