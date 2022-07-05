<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $cast = [
        "created_at"=>"datetime"
    ];
    function personnel(){
        return $this->belongsTo(Personnel::class);
    }

    function produit(){
        return $this->belongsTo(Produit::class);
    }
}
