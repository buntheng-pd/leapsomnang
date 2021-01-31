<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEchoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('echoes', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->date('date');
          $table->string('pt_no');
          $table->string('pt_name');
          $table->string('pt_age');
          $table->string('pt_gender')->nullable();
          $table->string('pt_phone')->nullable();
          $table->string('image', 255)->default('default.png');
          $table->text('description');
          $table->unsignedBigInteger('patient_id')->nullable();
          $table->unsignedBigInteger('echo_default_description_id');
          $table->unsignedBigInteger('created_by');
          $table->unsignedBigInteger('updated_by');
          $table->timestamps();

          $table->foreign('patient_id')
              ->references('id')->on('patients')
              ->onDelete('cascade')
              ->onUpdate('cascade');

          $table->foreign('echo_default_description_id')
              ->references('id')->on('echo_default_descriptions')
              ->onDelete('no action')
              ->onUpdate('no action');

          $table->foreign('created_by')
              ->references('id')->on('users')
              ->onDelete('no action')
              ->onUpdate('no action');

          $table->foreign('updated_by')
              ->references('id')->on('users')
              ->onDelete('no action')
              ->onUpdate('no action');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('echoes');
    }
}
