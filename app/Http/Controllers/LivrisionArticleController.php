<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LivrisionArticle;
use Illuminate\Http\Request;

class LivrisionArticleController extends Controller
{
    public function addArticlTolivraison(Request $request){
        $id = $request->input("livraison_id");
        $articl_id = $request->input("id");

        if($id){
            if($articl_id){
                $articl = LivrisionArticle::find($articl_id);
                $message = "Article updated successfully";
            }else{
                $articl = new LivrisionArticle();
                $message = "Article added successfully";
            }

            $articl->livrision_id = $id;
            $articl->vetement_id = $request->input("vetement_id");
            $articl->couleur_id = $request->input("couleur_id");
            $articl->taille = $request->input("taille");
            $articl->qte = $request->input("qte");
            $articl->save();

            return response()->json(['success' => true, 'message' => $message]);
        }
    }
    public function deleteArticlFromlivraison($id){
        LivrisionArticle::destroy($id);
        return response()->json(['success' => true, 'message' => 'Article deleted successfully']);


    }
}
