<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries_source', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquiry_id')->unsigned();
            $table->integer('enquiry_source_id')->unsigned();
            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
            $table->foreign('enquiry_source_id')->references('id')->on('enquiry_sources')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      
        Schema::table('enquiries_source', function(Blueprint $table){
            $table->dropForeign('enquiries_source_enquiry_id_foreign');
        });

        Schema::table('enquiries_source', function(Blueprint $table){
            $table->dropForeign('enquiries_source_enquiry_source_id_foreign');
        });

        Schema::dropIfExists('enquiries_source');
    }
}
