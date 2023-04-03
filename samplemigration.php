<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToNewRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_requests', function (Blueprint $table) {
            $table->string('request_name')->unsigned();
            $table->foreign('request_name')->references('request_name')->on('kind_of_requests')->onDelete('cascade');

            $table->string('unit_name')->unsigned();
            $table->foreign('unit_name')->references('unit_name')->on('units')->onDelete('cascade');

            $table->unsignedBigInteger('inspection_id');
            $table->foreign('inspection_id')->references('id')->on('inspections')->onDelete('cascade');

            $table->string('status_name')->unsigned();
            $table->foreign('status_name')->references('status_name')->on('status')->onDelete('cascade');

            $table->unsignedBigInteger('designer_id');
            $table->foreign('designer_id')->references('id')->on('designers')->onDelete('cascade');

            $table->string('request_code')->unsigned();
            $table->foreign('request_code')->references('request_code')->on('codes')->onDelete('cascade');

            // $table->string('attachment_id ')->unsigned();
            // $table->foreign('attachment_id')->references('')
            $table->string('inputted_by')->unsigned();
            $table->foreign('inputted_by')->references('employee_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_requests', function (Blueprint $table) {
            $table->dropColumn('request_name');
            $table->dropColumn('unit_name');
            $table->dropColumn('inspection_id');
            $table->dropColumn('status_name');
            $table->dropColumn('designer_id');
            $table->dropColumn('request_code');
            $table->dropColumn('inputted_by');
        });
    }
}
