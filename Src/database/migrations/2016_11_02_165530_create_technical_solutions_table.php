<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnicalSolutionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('technical_solutions',
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
        Schema::dropIfExists('technical_solutions');
    }

}
