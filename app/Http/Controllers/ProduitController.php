<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Storage;
use stdClass;

class ProduitController extends Controller
{
    //

    function store(Request $request){
        $request->validate([
            "nom"=>"required | string |unique:produits,nom",
            "prix"=>"integer|required",
            "image"=>"file|required",
            "image1"=>"file|required",
            "quantite"=>"required|integer"
        ]);

        $produit = new Produit();
        $produit->nom = $request->nom;
        $produit->prix = $request->prix;
        $produit->quantite = $request->quantite;
        $produit->image = $request->file("image")->store("public");
        $produit->image1 = $request->file("image1")->store("public");

        //j'enregistre
        $produit->save();
        $request->session()->flash('success', "produit enregistre avec success");
        return redirect()->route("admin.produit.index");
    }

    function update(Request $request,$id){
        $request->validate([
            "nom"=>"required | string ",
            "prix"=>"integer|required",
            "quantite"=>"required|integer"
        ]);
        $produit = Produit::findOrFail($id);
        if($request->file("image")!=null){
            Storage::disk("public")->delete($produit->image);
            $produit->image = $request->file("image")->store("public");
        }
        if($request->file("image1")!=null){
            Storage::disk("public")->delete($produit->image1);
            $produit->image = $request->file("image1")->store("public");
        }

        $produit->nom = $request->nom;
        $produit->quantite = $request->quantite;
        $produit->prix = $request->prix;

        $produit->save();
        return redirect()->route("admin.produit.index")->withSuccess("produit edite avec success");
    }

    function destroy($id){
        $produit = Produit::findOrFail($id);
        Storage::delete($produit->image);
        Storage::delete($produit->image1);
        $produit->delete();
        return redirect()->route("admin.produit.index")->withSuccess("produit supprimer avec success");
    }

    function commander(Request $request,$id){
        $cart = session("cart",[]);
        $qte = $request->input("quantite");
        $cart["$id"] = $qte;
        session()->put("cart",$cart);
        return redirect()->route("produit.cart.index");
    }
    function cart(){
        $cart = session("cart",[]);
        $index = array_keys($cart);
        $items = [];
        $pt = 0;
        foreach($index as $i){
            $temp = Produit::findOrFail($i);
            $tmp = new stdClass();
            $tmp->nom = $temp->nom;
            $tmp->qte = $cart["$i"];
            $tmp->pu = $temp->prix;
            $tmp->pt = $temp->prix * $cart["$i"];
            $tmp->img1 = $temp->image;
            $tmp->img2 = $temp->image1;
            $tmp->id = $temp->id;
            $items[] = $tmp;
            $pt = $pt+$tmp->pt;
        }
        return view("cart",compact("items","pt"));
    }
}
