<?php

namespace App\Http\Controllers;

use App\Models\Entre;
use App\Models\Produit;
use App\Models\Sortie;
use Illuminate\Http\Request;

class SortieProduitController extends Controller
{
    //
    public function index(){
        $sorties = Sortie::query()->select("*")->distinct()->get();
        return view("admin.sorties.index",compact("sorties"));
    }
    function store(Request $request){
        $request->validate([
            "produit_id"=>["integer","required"],
            "quantite"=>["required","integer"]
        ]);

        $created = Sortie::query()->create([
            "produit_id"=>$request->produit_id,
            "quantite"=>$request->quantite,
            "personnel_id"=>$request->user()->admin->id
        ]);

        Produit::query()->where("id","=",$request->produit_id)->decrement("quantite",$request->quantite);
        return redirect()->route("admin.sorties.index")->with("message.success","sorties enregistre avec success");
    }
}
