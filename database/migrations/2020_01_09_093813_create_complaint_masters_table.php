<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_masters', function (Blueprint $table) {
            $table->bigInteger('complaint_id')->primary();
            $table->bigInteger('emp_code');
            $table->bigInteger('asset_id');
            $table->integer('row_no');
            $table->integer('desk_no');
            $table->string('asset_category', 100);
            $table->string('asset_name', 100);
            $table->string('compaint_desc');
            $table->integer('status');
            $table->foreign('emp_code')->references('emp_code')->on('user_masters');
            $table->foreign('asset_id')->references('asset_id')->on('asset_masters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaint_masters');
    }
}
