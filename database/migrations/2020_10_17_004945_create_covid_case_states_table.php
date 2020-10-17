<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidCaseStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_case_states', function (Blueprint $table) {
            $table->id();
            $table->integer('uid');
            $table->string('uf');
            $table->string('state');
            $table->bigInteger('cases');
            $table->bigInteger('deaths');
            $table->bigInteger('suspects');
            $table->bigInteger('refuses');
            $table->datetime('datetime');
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
        Schema::dropIfExists('covid_case_states');
    }
}
