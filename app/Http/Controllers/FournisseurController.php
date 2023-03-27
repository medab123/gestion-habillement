<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;


class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::all(); // retrieve all fournisseurs from the database
        return view('fournisseurs.index', compact('fournisseurs')); // return the view with the fournisseurs data
    }

    public function create()
    {
        return view('fournisseurs.create'); // return the view to create a new fournisseur
    }
    public function saveFournisseur(Request $request)
    {
        // get the form data
        $id = $request->input('id');
        $name = $request->input('name');
        $lname = $request->input('lname');
        $tel = $request->input('tel');
        $email = $request->input('email');
        $addresse = $request->input('addresse');

        // determine whether to create or update the record
        if ($id) {
            // update the existing record
            $fournisseur = Fournisseur::find($id);
            $fournisseur->name = $name;
            $fournisseur->tel = $tel;
            $fournisseur->lname = $lname;
            $fournisseur->email = $email;
            $fournisseur->addresse = $addresse;
            $fournisseur->save();
            return response()->json(['success' => true, 'message' => 'Fournisseur updated successfully']);
        } else {
            // create a new record
            $fournisseur = new Fournisseur();
            $fournisseur->name = $name;
            $fournisseur->tel = $tel;
            $fournisseur->lname = $lname;
            $fournisseur->email = $email;
            $fournisseur->addresse = $addresse;
            $fournisseur->save();

            return response()->json(['success' => true, 'message' => 'Fournisseur created successfully']);
        }
    }

    public function store(Request $request)
    {
        $fournisseur = new Fournisseur(); // create a new fournisseur instance
        $fournisseur->name = $request->name; // assign the name value from the request to the fournisseur instance
        $fournisseur->lname = $request->lname; // assign the lname value from the request to the fournisseur instance
        $fournisseur->function_id = $request->function_id; // assign the function_id value from the request to the fournisseur instance
        $fournisseur->adresse = $request->adresse; // assign the adresse value from the request to the fournisseur instance
        $fournisseur->save(); // save the new fournisseur instance to the database
        return response()->json(['success' => true]); // return a JSON response indicating success
    }

    public function edit($id)
    {
        $fournisseur = Fournisseur::findOrFail($id); // retrieve the fournisseur with the given ID from the database
        return view('fournisseurs.edit', compact('fournisseur')); // return the view to edit the fournisseur
    }

    public function update(Request $request, $id)
    {
        $fournisseur = Fournisseur::findOrFail($id); // retrieve the fournisseur with the given ID from the database
        $fournisseur->name = $request->name; // assign the name value from the request to the fournisseur instance
        $fournisseur->lname = $request->lname; // assign the lname value from the request to the fournisseur instance
        $fournisseur->function_id = $request->function_id; // assign the function_id value from the request to the fournisseur instance
        $fournisseur->adresse = $request->adresse; // assign the adresse value from the request to the fournisseur instance
        $fournisseur->save(); // save the updated fournisseur instance to the database
        return response()->json(['success' => true]); // return a JSON response indicating success
    }

    public function destroy($id)
    {
        $fournisseur = Fournisseur::findOrFail($id); // retrieve the fournisseur with the given ID from the database
        $fournisseur->delete(); // delete the fournisseur from the database
        return response()->json(['success' => true]); // return a JSON response indicating success
    }
}
