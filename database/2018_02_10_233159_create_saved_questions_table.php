<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavedQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('question_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('classsubject_id')->unsigned();
            $table->foreign('classsubject_id')->references('id')->on('classsubject');
            $table->timestamp('created_at')->useCurrent = true; 
            $table->timestamp('updated_at')->useCurrent = true;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saved_questions');
    }
}
