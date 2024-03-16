<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activity');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('forum_id')->unsigned()->nullable();
            $table->foreign('forum_id')->references('id')->on('forums');
            $table->integer('reply_id')->unsigned()->nullable();
            $table->foreign('reply_id')->references('id')->on('replies');
            $table->integer('question_id')->nullable();
            $table->string('question_type')->nullable();
            $table->integer('exam_id')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
