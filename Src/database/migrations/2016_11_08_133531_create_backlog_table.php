<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBacklogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backlog', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->unsignedInteger('id_user');

            $table->foreign('id_user')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->unsignedInteger('id_project');
            $table->foreign('id_project')
                  ->references('id')->on('projects')
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
        Schema::dropIfExists('backlog');
    }
}
