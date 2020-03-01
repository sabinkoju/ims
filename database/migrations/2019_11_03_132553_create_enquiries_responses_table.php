<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquiry_id')->unsigned();
            $table->integer('enquiry_response_id')->unsigned();
            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
            $table->foreign('enquiry_response_id')->references('id')->on('enquiry_sources')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiries_responses', function(Blueprint $table){
            $table->dropForeign('enquiries_responses_enquiry_id_foreign');
        });

        Schema::table('enquiries_responses', function(Blueprint $table){
            $table->dropForeign('enquiries_responses_enquiry_response_id_foreign');
        });

        Schema::dropIfExists('enquiries_responses');
    }
}
