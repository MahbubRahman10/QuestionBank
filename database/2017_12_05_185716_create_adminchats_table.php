<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminchats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id');
            $table->string('sender_name');
            $table->integer('destination_id');
            $table->string('message');
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
        Schema::dropIfExists('adminchats');
    }
}
