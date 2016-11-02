<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHierarchyTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('projects_hiearchies',
                function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description');
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')
                    ->references('id')->on('projects')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('projects_hiearchies');
    }

}
