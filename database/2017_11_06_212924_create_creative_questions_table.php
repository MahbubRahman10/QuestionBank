<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreativeQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creative_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_name');
            $table->integer('classsubject_id')->unsigned();
            $table->foreign('classsubject_id')->references('id')->on('classsubject');
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->string('question_no_1');
            $table->string('question_no_2');
            $table->string('question_no_3');
            $table->string('question_no_4');
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
        Schema::dropIfExists('creative_questions');
    }
}
