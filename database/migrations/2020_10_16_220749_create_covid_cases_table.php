<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_cases', function (Blueprint $table) {
            $table->id();
            $table->string('city')->nullable();
            $table->string('city_ibge_code')->nullable();
            $table->bigInteger('confirmed');
            $table->string('confirmed_per_100k_inhabitants')->nullable();
            $table->date('date');
            $table->string('death_rate')->nullable();
            $table->bigInteger('deaths');
            $table->string('estimated_population')->nullable();
            $table->string('estimated_population_2019')->nullable();
            $table->string('is_last')->nullable();
            $table->string('order_for_place')->nullable();
            $table->string('place_type')->nullable();
            $table->string('state')->nullable();
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
        Schema::dropIfExists('covid_cases');
    }
}
