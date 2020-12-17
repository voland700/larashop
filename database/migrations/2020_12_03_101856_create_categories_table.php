<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('name');
            $table->string('slug');
            $table->integer('active')->unsigned()->default(1);
            $table->integer('sort')->unsigned()->default(500);
            $table->string('h1')->nullable();;
            $table->string('meta_title')->nullable();;
            $table->string('meta_description')->nullable();;
            $table->text('description')->nullable();;
            $table->string('img')->nullable()->nullable();;
            $table->string('prev_img')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
