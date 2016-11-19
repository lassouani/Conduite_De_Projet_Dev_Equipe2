<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('projects',
                function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->boolean('public');
            $table->longText('description');
            $table->string('link');
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->unsignedInteger('id_sprint');
            $table->longText('technical_solutions');
            $table->longText('project_hierarchy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('projects');
    }

}
