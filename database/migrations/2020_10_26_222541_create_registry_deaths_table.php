<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistryDeathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registry_deaths', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('deaths_covid19', 12)->nullable();
            $table->decimal('deaths_indeterminate_2019', 12)->nullable();
            $table->decimal('deaths_indeterminate_2020', 12)->nullable();
            $table->decimal('deaths_others_2019', 12)->nullable();
            $table->decimal('deaths_others_2020', 12)->nullable();
            $table->decimal('deaths_pneumonia_2019', 12)->nullable();
            $table->decimal('deaths_pneumonia_2020', 12)->nullable();
            $table->decimal('deaths_respiratory_failure_2019', 12)->nullable();
            $table->decimal('deaths_respiratory_failure_2020', 12)->nullable();
            $table->decimal('deaths_sars_2019', 12)->nullable();
            $table->decimal('deaths_sars_2020', 12)->nullable();
            $table->decimal('deaths_septicemia_2019', 12)->nullable();
            $table->decimal('deaths_septicemia_2020', 12)->nullable();
            $table->decimal('deaths_total_2019', 12)->nullable();
            $table->decimal('deaths_total_2020', 12)->nullable();
            $table->decimal('epidemiological_week_2019', 12)->nullable();
            $table->decimal('epidemiological_week_2020', 12)->nullable();
            $table->decimal('new_deaths_covid19', 12)->nullable();
            $table->decimal('new_deaths_indeterminate_2019', 12)->nullable();
            $table->decimal('new_deaths_indeterminate_2020', 12)->nullable();
            $table->decimal('new_deaths_others_2019', 12)->nullable();
            $table->decimal('new_deaths_others_2020', 12)->nullable();
            $table->decimal('new_deaths_pneumonia_2019', 12)->nullable();
            $table->decimal('new_deaths_pneumonia_2020', 12)->nullable();
            $table->decimal('new_deaths_respiratory_failure_2019', 12)->nullable();
            $table->decimal('new_deaths_respiratory_failure_2020', 12)->nullable();
            $table->decimal('new_deaths_sars_2019', 12)->nullable();
            $table->decimal('new_deaths_sars_2020', 12)->nullable();
            $table->decimal('new_deaths_septicemia_2019', 12)->nullable();
            $table->decimal('new_deaths_septicemia_2020', 12)->nullable();
            $table->decimal('new_deaths_total_2019', 12)->nullable();
            $table->decimal('new_deaths_total_2020', 12)->nullable();
            $table->string('state');
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
        Schema::dropIfExists('registry_deaths');
    }
}
