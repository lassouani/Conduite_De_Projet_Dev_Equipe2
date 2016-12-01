<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserstoryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('userstory',
                function (Blueprint $table) {

            $table->increments('id');
            $table->string('description')->unique();
            $table->string('us');
            $table->unsignedInteger('id_project');

            $table->foreign('id_project')
                    ->references('id')->on('projects')
                    ->onDelete('cascade');
            $table->unsignedInteger('id_sprint');

            $table->foreign('id_sprint')
                    ->references('id')->on('sprint')
                    ->onDelete('cascade');

            $table->unsignedInteger('sprint_number');        

            $table->unsignedInteger('effort');
            $table->unsignedInteger('priority');

            $table->string('tracability')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('userstory');
    }

}
