<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSprintTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sprint',
                function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_project');
            $table->foreign('id_project')
                    ->references('id')->on('projects')
                    ->onDelete('cascade');
            $table->unsignedInteger('id_kanban');
            $table->foreign('id_kanban')
                    ->references('id')->on('kanban')
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
        Schema::dropIfExists('sprint');
    }

}
