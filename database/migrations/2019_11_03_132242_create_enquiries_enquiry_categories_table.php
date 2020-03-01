<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesEnquiryCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries_enquiry_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquiry_id')->unsigned();
            $table->integer('enquiry_category_id')->unsigned();
            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
            $table->foreign('enquiry_category_id')->references('id')->on('enquiry_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('enquiries_enquiry_categories', function(Blueprint $table){
            $table->dropForeign('enquiries_enquiry_categories_enquiry_category_id_foreign');
        });

        Schema::table('enquiries_enquiry_categories', function(Blueprint $table){
            $table->dropForeign('enquiries_enquiry_categories_enquiry_id_foreign');
        });

        Schema::dropIfExists('enquiries_enquiry_categories');
    }
}
