<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Personne;

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

    public function store(Request $request)
    {
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