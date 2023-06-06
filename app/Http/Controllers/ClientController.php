<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use Illuminate\Http\Request;
use App\Models\Client; // import the Client model

class ClientController extends Controller
{
    public function index()
    {
        $functions = Fonction::all();
        $clients = Client::with("function")->get(); // retrieve all clients from the database
        //dd($clients);
        return view('clients.index', compact('clients', 'functions')); // return the view with the clients data
    }

    public function create()
    {
        return view('clients.create'); // return the view to create a new client
    }
    public function saveClient(Request $request)
    {
        // get the form data
        $id = $request->input('id');
        $name = $request->input('name');
        $lname = $request->input('lname');
        $tele = $request->input('tel');
        $function_id = $request->input('function_id');
        $adresse = $request->input('adresse');
        $taille_chausseur = $request->input('taille_chausseur');
        $taille_pontallon = $request->input('taille_pontallon');
        $taille_costume = $request->input('taille_costume');
        $taille_chemise = $request->input('taille_chemise');
        $taille_tshurt = $request->input('taille_tshurt');
        $taille_ceinture = $request->input('taille_ceinture');
        // determine whether to create or update the record
        if ($id) {
            // update the existing record
            $client = Client::find($id);
        } else {
            // create a new record
            $client = new Client();
        }
        $client->name = $name;
        $client->tele = $tele;
        $client->lname = $lname;
        $client->function_id = $function_id;
        $client->adresse = $adresse;
        $client->taille_costume = $taille_costume;
        $client->taille_pontallon = $taille_pontallon;
        $client->taille_chemise = $taille_chemise;
        $client->taille_tshurt = $taille_tshurt;
        $client->taille_ceinture = $taille_ceinture;
        $client->taille_chausseur = $taille_chausseur;

        $client->save();
        return response()->json(['success' => true, 'message' => 'Client '.($id?'Created':'Updated').' successfully']);


    }

    public function store(Request $request)
    {
        $client = new Client(); // create a new client instance
        $client->name = $request->name; // assign the name value from the request to the client instance
        $client->lname = $request->lname; // assign the lname value from the request to the client instance
        $client->function_id = $request->function_id; // assign the function_id value from the request to the client instance
        $client->adresse = $request->adresse; // assign the adresse value from the request to the client instance
        $client->save(); // save the new client instance to the database
        return response()->json(['success' => true]); // return a JSON response indicating success
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id); // retrieve the client with the given ID from the database
        return view('clients.edit', compact('client')); // return the view to edit the client
    }
    public function show($id){

        $client = Client::with("function")->where("id",$id)->first();
        //dd($client);
        $functions = Fonction::all();

        return view("clients.show",compact("client","functions"));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id); // retrieve the client with the given ID from the database
        $client->name = $request->name; // assign the name value from the request to the client instance
        $client->lname = $request->lname; // assign the lname value from the request to the client instance
        $client->function_id = $request->function_id; // assign the function_id value from the request to the client instance
        $client->adresse = $request->adresse; // assign the adresse value from the request to the client instance
        $client->save(); // save the updated client instance to the database
        return response()->json(['success' => true]); // return a JSON response indicating success
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id); // retrieve the client with the given ID from the database
        $client->delete(); // delete the client from the database
        return response()->json(['success' => true]); // return a JSON response indicating success
    }
}
