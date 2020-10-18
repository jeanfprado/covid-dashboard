<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\CovidCase;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class SimpleChart extends BaseChart
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
            ->labels(array_keys($cases->groupBy('date')->map->keys()->toArray()))
            ->dataset('Obtos', array_values($cases->groupBy('date')->map->sum('deaths')->toArray()))
            ->dataset('Confirmados', array_values($cases->groupBy('date')->map->sum('confirmed')->toArray()));
    }
}
