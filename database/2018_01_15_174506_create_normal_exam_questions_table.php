<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNormalExamQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normal_exam_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classsubject_id')->unsigned();
            $table->foreign('classsubject_id')->references('id')->on('classsubject');
            $table->integer('section_id')->unsigned()->nullable();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->string('mcq_type');
            $table->string('question_name');
            $table->string('c1')->nullable();
            $table->string('c2')->nullable();
            $table->string('c3')->nullable();
            $table->string('option_no_1');
            $table->string('option_no_2');
            $table->string('option_no_3');
            $table->string('option_no_4');
            $table->string('correct_answer');
            $table->string('pexam')->nullable();
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
        Schema::dropIfExists('normal_exam_questions');
    }
}
