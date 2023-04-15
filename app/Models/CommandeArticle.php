<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeArticle extends Model
{
    use HasFactory;
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    public function vetement()
    {
        return $this->belongsTo(Vetement::class, 'vetement_id');
    }

    public function couleur()
    {
        return $this->belongsTo(Couleur::class, 'couleur_id');
    }
}
