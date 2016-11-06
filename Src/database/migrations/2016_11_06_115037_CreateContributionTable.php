<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribution', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('id_user');
            $table->foreign('id_user')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

           $table->unsignedInteger('id_project');
           $table->foreign('id_project')
                  ->references('id')->on('projects')
                  ->onDelete('cascade');
                  
            $table->boolean('confirmation')->default('1');

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
         Schema::dropIfExists('contribution');
    }
}
