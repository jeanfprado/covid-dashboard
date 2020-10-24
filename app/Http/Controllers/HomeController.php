<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\CovidCaseState;
use App\Models\CovidCase;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        $casePerStates = CovidCaseState::all();

        $modal = (new CovidCase)->newQuery();

        $modal->where('place_type', 'city');

        if ($request->has('state')) {
            $modal->where('state', $request->get('state'));
            $cases = $modal->select('city', 'deaths')->orderBy('city')->get();
            $listCity = $cases->groupBy('city')->map->max('deaths');
        } else{
            $listCity = [];
        }

        return view('dashboard', compact('casePerStates', 'listCity'));
    }
}
