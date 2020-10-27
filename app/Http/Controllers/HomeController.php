<?php

namespace App\Http\Controllers;

use App\Covid\CovidApi;
use App\Models\CovidCase;
use Illuminate\Http\Request;
use App\Models\CovidCaseState;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $totalWorld = null;

        $casePerStates = CovidCaseState::all();

        $casesDeathsForCities = $this->getCasesDeathsForCities($request);

        if (empty($casesDeathsForCities)) {
            $totalWorld = $this->getStatisticWorld();
        }

        return view('dashboard', compact('casePerStates', 'casesDeathsForCities', 'totalWorld'));
    }

    public function getCasesDeathsForCities(Request $request)
    {
        if ($request->has('state')) {
            return cache()->remember('covid-deaths-for-city-' . $request->get('state'), now()->addMinutes(60), function () use ($request) {
                $modal = (new CovidCase)->newQuery();

                $modal->where('place_type', 'city');

                $modal->where('state', $request->get('state'));
                $cases = $modal->select('city', 'deaths')->orderBy('city')->get();
                return $cases->groupBy('city')->map->max('deaths');
            });
        }

        return [];
    }

    public function getStatisticWorld()
    {
        return cache()->remember('covid-world', now()->addMinutes(120), function () {
            $api = new CovidApi;
            return  $api->getTotalCaseContirmedAndDeathWorld();
        });
    }
}
