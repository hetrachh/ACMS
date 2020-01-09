<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_masters', function (Blueprint $table) {
            $table->bigInteger('emp_code')->primary();
            $table->string('emp_name', 100);
            $table->string('emp_phno',100);
            $table->string('emp_email', 100);
            $table->string('emp_designation', 100);
            $table->string('emp_password', 100);
            $table->integer('emp_status');
            $table->integer('emp_type');
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
        Schema::dropIfExists('user_masters');
    }
}
