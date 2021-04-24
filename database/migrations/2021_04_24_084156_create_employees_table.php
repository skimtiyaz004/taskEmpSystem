<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('last_name',60);
            $table->string('first_name',60);
            $table->string('middle_name',60)->nullable();
            $table->string('email',60);
            $table->string('address',120);
            $table->string('department_id');
            $table->bigInteger('city_id')->unsigned()->index();
            $table->bigInteger('state_id')->unsigned()->index();
           $table->bigInteger('country_id')->unsigned()->index();
            $table->string('zip',10);
            $table->date('birthdate');
            $table->date('date_hired');
            $table->string('passwords');
            $table->softDeletes();
            $table->timestamps();
           // $table->foreign('country_id')->references('id')->on('cuntries');
        });
        Schema::table('employees', function($table) {
            $table->foreign('country_id')->references('id')->on('cuntries');
        });
        
        Schema::table('employees', function($table) {
            $table->foreign('city_id')->references('id')->on('cities');
        });
        Schema::table('employees', function($table) {
            $table->foreign('state_id')->references('id')->on('states');
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
