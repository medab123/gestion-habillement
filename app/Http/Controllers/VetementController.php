<?php

namespace App\Http\Controllers;

use App\Models\TypeProduit;
use App\Models\Vetement;
use Illuminate\Http\Request;

class VetementController extends Controller
{
    public function index()
    {
        $types = TypeProduit::all();
        $vetements = Vetement::with("type")->get();

        return view("vetements.index",compact("vetements","types"));
    }
    public function saveVetement(Request $request)   
    {
        // get the form data
        $id = $request->input('id');
        $name = $request->input('name');
        $type_id = $request->input('type_id');
        
        // determine whether to create or update the record
        if ($id) {
            // update the existing record
            $vetement = Vetement::find($id);
            $vetement->name = $name;
            $vetement->type_id = $type_id;
            $vetement->save();

            return response()->json(['success' => true, 'message' => 'Vetement updated successfully']);
        } else {
            // create a new record
            $vetement = new Vetement();
            $vetement->name = $name;
            $vetement->type_id = $type_id;
            $vetement->save();

            return response()->json(['success' => true, 'message' => 'Vetement created successfully']);
        }
    }
    public function destroy($id)
    {
        $fonction = Vetement::find($id);
        $fonction->delete();
        return  response()->json(['success' => true, 'message' => 'Vetement deleted successfully'], 200);
    }
}
