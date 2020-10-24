<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\CovidCase;

class CovidConfirmedDeathsPieChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    
    public function handler(Request $request): Chartisan
    {
        $modal = (new CovidCase)->newQuery();

        $modal->where('place_type', 'state');

        if ($request->has('state')) {
            $modal->where('state', $request->get('state'));
        }

        $cases = $modal->orderBy('date')->get();

        return Chartisan::build()
        ->labels(['Obtos', 'Confirmados'])
        ->dataset('COVID-19', [array_sum(array_values($cases->groupBy('state')->map->max('deaths')->toArray())), array_sum(array_values($cases->groupBy('state')->map->max('confirmed')->toArray()))]);
    }
}