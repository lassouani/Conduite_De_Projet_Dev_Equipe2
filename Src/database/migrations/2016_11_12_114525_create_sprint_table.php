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
            $table->unsignedInteger('sprint_number');
            $table->string('start_date');
            $table->string('end_date');
            $table->unsignedInteger('id_project');
            $table->foreign('id_project')
                    ->references('id')->on('projects')
                    ->onDelete('cascade');
            $table->unsignedInteger('id_us');
            $table->foreign('id_us')
                    ->references('id')->on('userstory')
                    ->onDelete('cascade');
            $table->string('selected_us');        
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
