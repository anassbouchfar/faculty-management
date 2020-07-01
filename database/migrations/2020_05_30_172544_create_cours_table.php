<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('user_id');
            $table->string('grp')->nullable();
            $table->string('prof')->nullable();
            $table->string('module')->nullable();
            $table->string('chapitre')->nullable();
            $table->string('titre')->nullable();
            $table->string('description')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cours');
    }
}
