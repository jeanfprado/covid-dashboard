<?php

declare(strict_types=1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use App\Models\RegistryDeath;
use Illuminate\Support\Carbon;
use ConsoleTVs\Charts\BaseChart;

class RegistryDeathsLineChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $cases = cache()->remember('registry-deaths-' . $request->get('state'), now()->addMinutes(60), function () use ($request) {
            $modal = (new RegistryDeath)->newQuery();

            if ($request->has('state')) {
                $modal->where('state', $request->get('state'));
            }

            return $modal->orderBy('date')->get();
        });

        $data = $cases->groupBy(function ($val) {
            return Carbon::parse($val->date)->format('M');
        });

        $deaths2019 = $data->map(function ($item, $key) {
            return array_sum($item->groupBy('state')->map->max('deaths_total_2019')->toArray());
        })->toArray();

        $deaths2020 = $data->map(function ($item, $key) {
            return array_sum($item->groupBy('state')->map->max('deaths_total_2020')->toArray());
        })->toArray();

        $deaths2020WithouCovid = $data->map(function ($item, $key) {
            return (array_sum($item->groupBy('state')->map->max('deaths_total_2020')->toArray()) - array_sum($item->groupBy('state')->map->max('deaths_covid19')->toArray()));
        })->toArray();

        return Chartisan::build()
            ->labels(['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'])
            ->dataset('2019', array_values($deaths2019))
            ->dataset('2020', array_values($deaths2020))
            ->dataset('2020 - Sem Covid', array_values($deaths2020WithouCovid));
    }
}
