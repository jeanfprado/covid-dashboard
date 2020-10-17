<?php

namespace App\Imports;

use App\Models\CovidCase;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class CovidImport implements ToModel, WithProgressBar
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
            'date' => $row[0],
            'state' => $row[1],
            'city' => $row[2],
            'place_type' => $row[3],
            'confirmed' => $row[4],
            'deaths' => $row[5],
            'order_for_place' => $row[6],
            'is_last' => $row[7],
            'estimated_population_2019' => $row[8],
            'estimated_population' => $row[9],
            'city_ibge_code' => $row[10],
            'confirmed_per_100k_inhabitants' => $row[11],
            'death_rate' => $row[12],
        ]);
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
