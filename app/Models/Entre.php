<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entre extends Model
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
