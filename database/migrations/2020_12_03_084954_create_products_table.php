<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('slug');
            $table->integer('active')->unsigned()->default(1);
            $table->integer('hit')->unsigned()->default(0);
            $table->integer('new')->unsigned()->default(0);
            $table->integer('stock')->unsigned()->default(0);
            $table->integer('advice')->unsigned()->default(0);
            $table->integer('sort')->unsigned()->default(500);
            $table->integer('category_id')->unsigned();
            $table->string('h1')->nullable();;
            $table->string('meta_title')->nullable();;
            $table->string('meta_description')->nullable();;
            $table->text('prev')->nullable();;
            $table->text('description')->nullable();;
            $table->string('img')->nullable();
            $table->string('prev_img')->nullable();
            $table->decimal('base_price', 10, 2, true)->default(0);
            $table->decimal('price', 10, 2, true)->default(0);
            $table->string('currency')->default('RUB');
            $table->json('properties')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
