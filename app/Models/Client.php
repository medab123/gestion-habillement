<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'lname', 'function_id', 'adresse'
    ];

    public function function()
    {
        return $this->belongsTo(Fonction::class);
    }
}
