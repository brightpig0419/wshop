<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class');
            $table->string('jancode');
            $table->string('name_jp');
            $table->string('name_cn');
            $table->string('weigth');
            $table->string('option');
            $table->string('img_url');
            $table->string('img_url2');
            $table->string('size');
            $table->string('component');
            $table->string('price');
            $table->string('status');
            $table->string('description');
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
        //
    }
}
