<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostitemnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('postitemno', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_item_no');
            $table->string('type');
            $table->string('send_time');
            $table->string('arrive_time');
            $table->string('add_id');
            $table->string('weight');
            $table->string('price');
            $table->string('contents');
            $table->string('status');
            $table->string('description');
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
        Schema::drop('postitemno');
    }
}
