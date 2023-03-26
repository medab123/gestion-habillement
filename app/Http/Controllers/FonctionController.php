<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use Illuminate\Http\Request;

class FonctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $functions = Fonction::all();

        return view("functions.index",compact("functions"));
    }

    public function saveFunction(Request $request)
    {
        // get the form data
        $id = $request->input('id');
        $name = $request->input('name');
        
        // determine whether to create or update the record
        if ($id) {
            // update the existing record
            $function = Fonction::find($id);
            $function->name = $name;
            $function->save();

            return response()->json(['success' => true, 'message' => 'Function updated successfully']);
        } else {
            // create a new record
            $function = new Fonction();
            $function->name = $name;
            $function->save();

            return response()->json(['success' => true, 'message' => 'Function created successfully']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Fonction $fonction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fonction $fonction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fonction $fonction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fonction = Fonction::find($id);
        $fonction->delete();
        return  response()->json(['success' => true, 'message' => 'Function deleted successfully'], 200);
    }
}
