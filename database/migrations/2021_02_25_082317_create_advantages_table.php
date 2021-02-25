<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvantagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advantage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('active')->unsigned()->default(1);
            $table->integer('sort')->unsigned()->default(10);
            $table->string('icon')->default('thumb_up');
            $table->text('text')->nullable();
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
        Schema::dropIfExists('advantages');
    }
}
