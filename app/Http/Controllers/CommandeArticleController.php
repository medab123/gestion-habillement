<?php

namespace App\Http\Controllers;

use App\Models\CommandeArticle;
use Illuminate\Http\Request;

class CommandeArticleController extends Controller
{
    public function addArticlToCommande(Request $request){
        $id = $request->input("commande_id");
        $articl_id = $request->input("id");

        if($id){
            if($articl_id){
                $articl = CommandeArticle::find($articl_id);
                $message = "Article updated successfully";
            }else{
                $articl = new CommandeArticle();
                $message = "Article added successfully";
            }

            $articl->commande_id = $id;
            $articl->vetement_id = $request->input("vetement_id");
            $articl->couleur_id = $request->input("couleur_id");
            $articl->taille = $request->input("taille");
            $articl->qte = $request->input("qte");
            $articl->save();

            return response()->json(['success' => true, 'message' => $message]);
        }
    }
    public function deleteArticlFromCommande($id){
        CommandeArticle::destroy($id);
        return response()->json(['success' => true, 'message' => 'Article deleted successfully']);


    }
}
