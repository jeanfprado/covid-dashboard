<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistryDeath extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'deaths_covid19', 'deaths_indeterminate_2019', 'deaths_indeterminate_2020', 'deaths_others_2019', 'deaths_others_2020', 'deaths_pneumonia_2019', 'deaths_pneumonia_2020', 'deaths_respiratory_failure_2019', 'deaths_respiratory_failure_2020', 'deaths_sars_2019', 'deaths_sars_2020', 'deaths_septicemia_2019', 'deaths_septicemia_2020', 'deaths_total_2019', 'deaths_total_2020', 'epidemiological_week_2019', 'epidemiological_week_2020', 'new_deaths_covid19', 'new_deaths_indeterminate_2019', 'new_deaths_indeterminate_2020', 'new_deaths_others_2019', 'new_deaths_others_2020', 'new_deaths_pneumonia_2019', 'new_deaths_pneumonia_2020', 'new_deaths_respiratory_failure_2019', 'new_deaths_respiratory_failure_2020', 'new_deaths_sars_2019', 'new_deaths_sars_2020', 'new_deaths_septicemia_2019', 'new_deaths_septicemia_2020', 'new_deaths_total_2019', 'new_deaths_total_2020', 'state',
    ];
}
