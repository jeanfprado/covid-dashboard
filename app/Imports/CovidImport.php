<?php

namespace App\Imports;

use App\Models\CovidCase;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class CovidImport implements ToModel, WithProgressBar, WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return CovidCase::create([
            'date' => $row['date'],
            'state' => $row['state'],
            'city' => $row['city'],
            'place_type' => $row['place_type'],
            'confirmed' => $row['confirmed'],
            'deaths' => $row['deaths'],
            'order_for_place' => $row['order_for_place'],
            'is_last' => $row['is_last'],
            'estimated_population_2019' => $row['estimated_population_2019'],
            'estimated_population' => $row['estimated_population'],
            'city_ibge_code' => $row['city_ibge_code'],
            'confirmed_per_100k_inhabitants' => $row['confirmed_per_100k_inhabitants'],
            'death_rate' => $row['death_rate'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
