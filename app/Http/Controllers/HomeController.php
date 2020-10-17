<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CovidCaseState;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $casePerStates = CovidCaseState::all();

        return view('dashboard', compact('casePerStates'));
    }
}
