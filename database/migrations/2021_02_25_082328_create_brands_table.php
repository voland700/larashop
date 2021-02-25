<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('active')->unsigned()->default(1);
            $table->integer('slider')->unsigned()->default(1);
            $table->integer('sort')->unsigned()->default(100);
            $table->string('img')->nullable();
            $table->text('description')->nullable();
            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keys')->nullable();
            $table->string('meta_description')->nullable();
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
        Schema::dropIfExists('brands');
    }
}
