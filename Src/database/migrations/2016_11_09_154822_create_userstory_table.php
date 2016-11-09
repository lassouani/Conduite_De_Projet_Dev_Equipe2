<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserstoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userstory', function (Blueprint $table) {

            $table->increments('id');
            $table->string('description');
            $table->unsignedInteger('id_b');

            $table->foreign('id_b')
                  ->references('id')->on('backlog')
                  ->onDelete('cascade');

            $table->unsignedInteger('effort');
            $table->unsignedInteger('priority');

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
         Schema::drop('userstory');
    }
}
