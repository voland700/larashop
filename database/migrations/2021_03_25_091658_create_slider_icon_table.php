<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderIconTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_icon', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->tinyInteger('active')->unsigned()->default(1);
            $table->integer('sort')->unsigned()->default(50);
            $table->string('img');
            $table->string('link')->nullable();
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
        Schema::dropIfExists('slider_icon');
    }
}
