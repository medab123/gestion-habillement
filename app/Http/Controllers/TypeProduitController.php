<?php

namespace App\Http\Controllers;

use App\Models\TypeProduit;
use Illuminate\Http\Request;

class TypeProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeProduits = TypeProduit::all();

        return view("typeProduits.index",compact("typeProduits"));
    }

    public function saveTypeProduit(Request $request)   
    {
        // get the form data
        $id = $request->input('id');
        $name = $request->input('name');
        
        // determine whether to create or update the record
        if ($id) {
            // update the existing record
            $typeProduit = TypeProduit::find($id);
            $typeProduit->name = $name;
            $typeProduit->save();

            return response()->json(['success' => true, 'message' => 'TypeProduit updated successfully']);
        } else {
            // create a new record
            $typeProduit = new TypeProduit();
            $typeProduit->name = $name;
            $typeProduit->save();

            return response()->json(['success' => true, 'message' => 'TypeProduit created successfully']);
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
    public function show(TypeProduit $fonction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeProduit $fonction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeProduit $fonction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fonction = TypeProduit::find($id);
        $fonction->delete();
        return  response()->json(['success' => true, 'message' => 'TypeProduit deleted successfully'], 200);
    }
}
