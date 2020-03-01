<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchShiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_shift', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('batch_id')->unsigned();
            $table->integer('shift_id')->unsigned();
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('batch_shift', function (Blueprint $table) {
            $table->dropForeign('batch_shift_batch_id_foreign');
        });

          Schema::table('batch_shift', function(Blueprint $table){
            $table->dropForeign('batch_shift_shift_id_foreign');
        });

        Schema::dropIfExists('batch_shift');
    }
}
