<?php

namespace App\Http\Controllers;

use App\Models\Entre;
use App\Models\Produit;
use Illuminate\Http\Request;

class EntreProduitController extends Controller
{
    //
    public function index(){
        $entres = Entre::query()->select("*")->distinct()->get();
        return view("admin.entres.index",compact("entres"));
    }
    function store(Request $request){
        $request->validate([
            "produit_id"=>["integer","required"],
            "quantite"=>["required","integer"]
        ]);

        $created = Entre::query()->create([
            "produit_id"=>$request->produit_id,
            "quantite"=>$request->quantite,
            "personnel_id"=>$request->user()->admin->id
        ]);
        Produit::query()->where("id","=",$request->produit_id)->increment("quantite",$request->quantite);
        return redirect()->route("admin.entres.index")->with("message.success","Entres enregistre avec success");
    }
}
