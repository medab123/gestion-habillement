<?php

namespace App\Http\Controllers;

use App\Models\Tailleur;
use Illuminate\Http\Request;

class TailleurController extends Controller
{
    public function index()
    {
        $tailleurs = Tailleur::all(); // retrieve all tailleurs from the database
        //dd($tailleurs);
        return view('tailleurs.index', compact('tailleurs')); // return the view with the tailleurs data
    }

    public function create()
    {
        return view('tailleurs.create'); // return the view to create a new tailleur
    }
    public function saveTailleur(Request $request)
    {
        // get the form data
        $id = $request->input('id');
        $name = $request->input('name');
        $lname = $request->input('lname');
        $tele = $request->input('tel');
        $adresse = $request->input('adresse');

        // determine whether to create or update the record
        if ($id) {
            // update the existing record
            $tailleur = Tailleur::find($id);
            $tailleur->name = $name;
            $tailleur->tele = $tele;
            $tailleur->lname = $lname;
            $tailleur->adresse = $adresse;
            $tailleur->save();

            return response()->json(['success' => true, 'message' => 'Tailleur updated successfully']);
        } else {
            // create a new record
            $tailleur = new Tailleur();
            $tailleur->name = $name;
            $tailleur->tele = $tele;
            $tailleur->lname = $lname;
            $tailleur->adresse = $adresse;
            $tailleur->save();

            return response()->json(['success' => true, 'message' => 'Tailleur created successfully']);
        }
    }

    public function store(Request $request)
    {
        $tailleur = new Tailleur(); // create a new tailleur instance
        $tailleur->name = $request->name; // assign the name value from the request to the tailleur instance
        $tailleur->lname = $request->lname; // assign the lname value from the request to the tailleur instance
        $tailleur->adresse = $request->adresse; // assign the adresse value from the request to the tailleur instance
        $tailleur->save(); // save the new tailleur instance to the database
        return response()->json(['success' => true]); // return a JSON response indicating success
    }

    public function edit($id)
    {
        $tailleur = Tailleur::findOrFail($id); // retrieve the tailleur with the given ID from the database
        return view('tailleurs.edit', compact('tailleur')); // return the view to edit the tailleur
    }

    public function update(Request $request, $id)
    {
        $tailleur = Tailleur::findOrFail($id); // retrieve the tailleur with the given ID from the database
        $tailleur->name = $request->name; // assign the name value from the request to the tailleur instance
        $tailleur->lname = $request->lname; // assign the lname value from the request to the tailleur instance
        $tailleur->adresse = $request->adresse; // assign the adresse value from the request to the tailleur instance
        $tailleur->save(); // save the updated tailleur instance to the database
        return response()->json(['success' => true]); // return a JSON response indicating success
    }

    public function destroy($id)
    {
        $tailleur = Tailleur::findOrFail($id); // retrieve the tailleur with the given ID from the database
        $tailleur->delete(); // delete the tailleur from the database
        return response()->json(['success' => true]); // return a JSON response indicating success
    }
}
