<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportFileController extends Controller
{
    public function create()
    {
        return view('import-file');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,txt'
        ]);

       $request->file('file')->storeAs('/', 'caso.csv', 'local');

        return redirect()->back()->with('success', 'Arquivo enviado com sucesso!');
    }
}
