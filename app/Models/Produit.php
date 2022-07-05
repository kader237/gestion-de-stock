<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    function entre(){
        return $this->hasOne(Entre::class);
    }
    function sortie(){
        return $this->hasOne(Sortie::class);
    }
    function commandes(){
        return $this->hasMany(Commande::class);
    }
}
