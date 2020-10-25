<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\CovidCase;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class CovidConfirmedDeathsBarChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $cases = cache()->remember('covid-confirmed-deaths-bar-chart-' . $request->get('state'), now()->addMinutes(60), function () use ($request) {
            $modal = (new CovidCase)->newQuery();

            $modal->where('place_type', 'state');

            if ($request->has('state')) {
                $modal->where('state', $request->get('state'));
            }

            return $modal->orderBy('date')->get();
        });

        return Chartisan::build()
            ->labels(array_keys($cases->groupBy('date')->map->keys()->toArray()))
            ->dataset('Obtos', array_values($cases->groupBy('date')->map->sum('deaths')->toArray()))
            ->dataset('Confirmados', array_values($cases->groupBy('date')->map->sum('confirmed')->toArray()));
    }
}
