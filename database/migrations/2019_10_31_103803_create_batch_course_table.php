<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_course', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('batch_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('batch_course', function(Blueprint $table){
            $table->dropForeign('batch_course_batch_id_foreign');
        });

        Schema::table('batch_course', function(Blueprint $table){
            $table->dropForeign('batch_course_course_id_foreign');
        });

        Schema::dropIfExists('batch_course');
    }
}
