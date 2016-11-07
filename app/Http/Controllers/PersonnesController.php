<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Personne;
use App\Http\Requests\PersonneStoreRequest;

class PersonnesController extends Controller
{
    public function index()
    {
    	$personnes = Personne::all();
    	return View::make('personnes.index', compact('personnes'));
    }

    public function create()
    {
    	return View::make('personnes.create');
    }

    public function store(PersonneStoreRequest $request)
    {
    	dd($request->all());
    	$personne = Personne::create($request->all());
    	dd($personne);
    }
 
    public function show($id)
    {
    	return View::make('personnes.show');
    }

    public function edit($id)
    {
    	return View::make('personnes.show'); 
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        //
    }
}
