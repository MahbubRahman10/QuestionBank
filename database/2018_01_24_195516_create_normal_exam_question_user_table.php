<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNormalExamQuestionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('normal_exam_question_user', function (Blueprint $table) {
            Schema::create('normal_exam_questions_user', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('normal_exam_question_id')->unsigned();
                $table->foreign('normal_exam_question_id')->references('id')->on('normal_exam_questions');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('exam_token');
                $table->string('answer')->nullable();
                $table->string('result')->nullable();
                $table->timestamp('created_at')->useCurrent = true; 
                $table->timestamp('updated_at')->useCurrent = true;
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('normal_exam_questions_user', function (Blueprint $table) {
            //
        });
    }
}
