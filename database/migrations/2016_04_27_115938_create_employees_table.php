<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo')->nullable();
            $table->string('code');
            $table->string('name');
            $table->string('surname');
            $table->tinyInteger('status');
            $table->tinyInteger('gender');
            $table->string('date_of_birth');
            $table->string('date_of_joining');
            $table->string('number');
            $table->string('qualification');
            $table->string('emergency_number');
            $table->string('current_address');
            $table->string('permanent_address');
            $table->tinyInteger('formalities');
            $table->tinyInteger('offer_acceptance');
            $table->string('probation_period');
            $table->string('date_of_confirmation');
            $table->string('department');
            $table->string('salary');
            $table->string('account_number');
            $table->string('bank_name');
            $table->tinyInteger('pf_status');
            $table->string('date_of_resignation');
            $table->string('notice_period');
            $table->string('last_working_day');
            $table->tinyInteger('full_final');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('employees');
    }
}
