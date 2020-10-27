<?php

namespace App\Imports;

use App\Models\RegistryDeath;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class RegistryImport implements ToModel, WithProgressBar, WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return RegistryDeath::create([
            'date' => $row['date'],
            'deaths_covid19' => $row['deaths_covid19'],
            'deaths_indeterminate_2019' => $row['deaths_indeterminate_2019'],
            'deaths_indeterminate_2020' => $row['deaths_indeterminate_2020'],
            'deaths_others_2019' => $row['deaths_others_2019'],
            'deaths_others_2020' => $row['deaths_others_2020'],
            'deaths_pneumonia_2019' => $row['deaths_pneumonia_2019'],
            'deaths_pneumonia_2020' => $row['deaths_pneumonia_2020'],
            'deaths_respiratory_failure_2019' => $row['deaths_respiratory_failure_2019'],
            'deaths_respiratory_failure_2020' => $row['deaths_respiratory_failure_2020'],
            'deaths_sars_2019' => $row['deaths_sars_2019'],
            'deaths_sars_2020' => $row['deaths_sars_2020'],
            'deaths_septicemia_2019' => $row['deaths_septicemia_2019'],
            'deaths_septicemia_2020' => $row['deaths_septicemia_2020'],
            'deaths_total_2019' => $row['deaths_total_2019'],
            'deaths_total_2020' => $row['deaths_total_2020'],
            'epidemiological_week_2019' => $row['epidemiological_week_2019'],
            'epidemiological_week_2020' => $row['epidemiological_week_2020'],
            'new_deaths_covid19' => $row['new_deaths_covid19'],
            'new_deaths_indeterminate_2019' => $row['new_deaths_indeterminate_2019'],
            'new_deaths_indeterminate_2020' => $row['new_deaths_indeterminate_2020'],
            'new_deaths_others_2019' => $row['new_deaths_others_2019'],
            'new_deaths_others_2020' => $row['new_deaths_others_2020'],
            'new_deaths_pneumonia_2019' => $row['new_deaths_pneumonia_2019'],
            'new_deaths_pneumonia_2020' => $row['new_deaths_pneumonia_2020'],
            'new_deaths_respiratory_failure_2019' => $row['new_deaths_respiratory_failure_2019'],
            'new_deaths_respiratory_failure_2020' => $row['new_deaths_respiratory_failure_2020'],
            'new_deaths_sars_2019' => $row['new_deaths_sars_2019'],
            'new_deaths_sars_2020' => $row['new_deaths_sars_2020'],
            'new_deaths_septicemia_2019' => $row['new_deaths_septicemia_2019'],
            'new_deaths_septicemia_2020' => $row['new_deaths_septicemia_2020'],
            'new_deaths_total_2019' => $row['new_deaths_total_2019'],
            'new_deaths_total_2020' => $row['new_deaths_total_2020'],
            'state' => $row['state'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
