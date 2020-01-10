<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_masters', function (Blueprint $table) {
            $table->bigInteger('asset_id')->primary();
            $table->string('asset_category', 100);
            $table->string('asset_name', 100);
            $table->bigInteger('emp_code')->nullable();
            $table->string('asset_remark', 100)->default('Working');
            $table->integer('asset_status')->default(1);
            $table->foreign('emp_code')->references('emp_code')->on('user_masters')->onDelete('cascade');
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
        Schema::dropIfExists('asset_masters');
    }
}
