<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livrision extends Model
{
    use HasFactory;
    protected $fillable = [
        'tailleur_id',
        'vetement_id',
    ];
    public function tailleur()
    {
        return $this->belongsTo(Tailleur::class, 'tailleur_id');
    }
    public function vetement()
    {
        return $this->belongsTo(Vetement::class, 'vetement_id');
    }
}
