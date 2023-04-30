<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Couleur;
use App\Models\Livrision;
use App\Models\LivrisionArticle;
use App\Models\Tailleur;
use App\Models\Vetement;
use Illuminate\Http\Request;

class LivrisionController extends Controller
{
    public function index()
    {
        $livrisions = Livrision::with("tailleur")->with("vetement")->get();
        $commandes  = Commande::with("tailleur")->get();
        $tailleurs  = Tailleur::all();
        $vetements  = Vetement::all();
        return view("livrisions.index", compact("tailleurs", "vetements","livrisions"));
    }
    public function saveLivrision(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            return response()->json(['success' => true, 'message' => 'Client updated successfully']);
        } else {
            // create a new record
            $data = $request->all();
            $commande = new Commande();
            $commande->tailleur_id = $data['tailleur_id'];
            $commande->date_commande = $data['date_commande'];
            $commande->save();
            // Loop through the vetement_id, couleur_id, taille, and qte arrays to associate them with the Commande model
            for ($i = 0; $i < count($data['vetement_id']); $i++) {
                $commandeItem = new LivrisionArticle();
                $commandeItem->commande_id = $commande->id;
                $commandeItem->vetement_id = $data['vetement_id'][$i];
                $commandeItem->couleur_id = $data['couleur_id'][$i];
                $commandeItem->taille = $data['taille'][$i];
                $commandeItem->qte = $data['qte'][$i];

                // Save the CommandeItem model
                $commandeItem->save();
            }

            // Save the Commande model


            return response()->json(['success' => true, 'message' => 'Client created successfully']);
        }
    }
    public function show($id){
        $tailleurs = Tailleur::all();
        $vetements = Vetement::all();
        $colors    = Couleur::all();
        //$commande = Commande::find($id);
        $commandeItems = CommandeArticle::where("commande_id",$id)->with("vetement","couleur","commande")->get();
        return view("commandes.show",compact("commandeItems",/*"commande",*/"vetements", "colors","tailleurs"));
    }
}
