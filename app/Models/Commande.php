<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $table = 'commandes';
    protected $fillable = [
        'tailleur_id',
        'date_commande',
    ];

    public function tailleur()
    {
        return $this->belongsTo(Tailleur::class, 'tailleur_id');
    }
}
