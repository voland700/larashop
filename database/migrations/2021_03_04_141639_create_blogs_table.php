<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('active')->unsigned()->default(1);
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('sort')->unsigned()->default(500);
            $table->string('img')->nullable();
            $table->string('prev_img')->nullable();
            $table->text('prev')->nullable();
            $table->string('location')->default('center');
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
        Schema::dropIfExists('blog');
    }
}
