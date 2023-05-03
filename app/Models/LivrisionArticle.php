<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivrisionArticle extends Model
{
    use HasFactory;
    public function couleur()
    {
        return $this->belongsTo(Couleur::class, 'couleur_id');
    }
    public function vetement()
    {
        return $this->belongsTo(Vetement::class, 'vetement_id');
    }
    public function livraison()
    {
        return $this->belongsTo(Livrision::class, 'livrision_id');
    }
}
