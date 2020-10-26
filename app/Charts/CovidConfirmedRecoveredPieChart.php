<?php

declare(strict_types=1);

namespace App\Charts;

use App\Covid\CovidApi;
use App\Models\CovidCase;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use App\Models\CovidCaseState;
use ConsoleTVs\Charts\BaseChart;

class CovidConfirmedRecoveredPieChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $cases = cache()->remember('covid-confirmed-recovered-pie-chart-' . $request->get('state'), now()->addMinutes(60), function () use ($request) {
            $api = new CovidApi;
            return  $api->getTotalCaseContirmedAndRecovered();
        });

        return Chartisan::build()
        ->labels(['Confirmados', 'Casos Ativos', 'Recuperados'])
        ->dataset('COVID-19 - Brasil', [$cases['confirmed'], ($cases['confirmed'] - $cases['recovered']), $cases['recovered']]);
    }
}
