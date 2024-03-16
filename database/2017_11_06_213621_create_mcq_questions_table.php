<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcqQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_name');
            $table->integer('classsubject_id')->unsigned();
            $table->foreign('classsubject_id')->references('id')->on('classsubject');
            $table->string('mcq_type');
            $table->string('c1')->nullable();
            $table->string('c2')->nullable();
            $table->string('c3')->nullable();
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->string('option_no_1');
            $table->string('option_no_2');
            $table->string('option_no_3');
            $table->string('option_no_4');
            $table->string('correct_answer');
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
        Schema::dropIfExists('mcq_questions');
    }
}
