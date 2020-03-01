<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherBatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_batch', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('batch_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_batch', function (Blueprint $table) {
            //
        });
    }
}
