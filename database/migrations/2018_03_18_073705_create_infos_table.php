<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->string('url');
            $table->string('city');
            $table->string('country');
            $table->string('email');
            $table->string('imageUrl');
            $table->string('itemId');
            $table->timestamps();
        });

//        Schema::table('infos', function (Blueprint $table) {
//            $table->string('itemId');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
