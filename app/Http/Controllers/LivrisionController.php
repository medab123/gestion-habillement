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
        $livraisons = Livrision::with("tailleur")->with("vetement")->get();
        $commandes  = Commande::get();
        $tailleurs  = Tailleur::all();
        $vetements  = Vetement::all();
        $couleurs   = Couleur::all();
        return view("livrisions.index", compact("tailleurs", "vetements","livraisons","commandes","couleurs"));
    }
    public function saveLivrision(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            $comande = Livrision::find($id);
            $comande->commande_id = $request->input("tailleur_id");
            $comande->tailleur_id = $request->input("tailleur_id");
            $comande->date_livrison = $request->input("date_livrison");
            $comande->save();
            return response()->json(['success' => true, 'message' => 'Livriason updated successfully']);
        } else {
            // create a new record
            $data = $request->all();
            $livrison = new Livrision();
            $livrison->commande_id = $data['commande_id'];
            $livrison->tailleur_id = $data['tailleur_id'];
            $livrison->date_livrison = $data['date_livrison'];
            $livrison->save();
            for ($i = 0; $i < count($data['vetement_id']); $i++) {
                $livrisonItem = new LivrisionArticle();
                $livrisonItem->livrision_id = $livrison->id;
                $livrisonItem->vetement_id = $data['vetement_id'][$i];
                $livrisonItem->couleur_id = $data['couleur_id'][$i];
                $livrisonItem->taille = $data['taille'][$i];
                $livrisonItem->qte = $data['qte'][$i];
                $livrisonItem->save();
            }
            return response()->json(['success' => true, 'message' => 'Client created successfully']);
        }
    }
    public function show($id){
        $tailleurs = Tailleur::all();
        $vetements = Vetement::all();
        $colors    = Couleur::all();
        $commandes  = Commande::get();

        //$commande = Commande::find($id);
        $livraisonItems = LivrisionArticle::where("livrision_id",$id)->with("vetement","livraison","couleur")->get();
        //dd($livraisonItems);
        return view("livrisions.show",compact("livraisonItems","commandes","vetements", "colors","tailleurs"));
    }
}
