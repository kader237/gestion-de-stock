<?php

namespace App\Http\Controllers;

use  PDF;
use stdClass;
use Carbon\Carbon;
use App\Models\Produit;
use App\Events\BuyBillEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

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

        if($cart != null){
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
        return redirect()->route("home")->withMessage("Desole votre Panier est vide");
    }
    public function buy(Request $request){
        // je genere la facture du client

        if(session()->get("cart") !== null){
            $commande = new stdClass;
        if($data = $request->input("number_money")){
            $commande->numero = $data;
        }
        $commande->mode_paiement = $request->get("mode_paiement");
        $commande->date_commande = Carbon::now()->toDateString();
        $commande->pt = $request->prix_total;
        $produit = [];
        $cart = session()->get("cart");
        foreach(array_keys(session()->get("cart")) as $v){
            $tmp = DB::table('produits')->select(["prix","nom","quantite"])->where("id","=",$v)->first();
            DB::table("produits")->where("id",$v)->update(["quantite"=>$tmp->quantite - $cart[$v]]);
            $tmp->quantite = session()->get("cart.$v");
            $tmp->pt = $tmp->prix * $tmp->quantite ;
            $produit[] = $tmp;
        }
        // j'enregistre ma commande

        // j'envoi un mail
        $commande->produits = $produit;
        $pdf = App::make("dompdf.wrapper");
        $facture = $pdf->loadView("facture",compact("commande"));
        $stream = $facture->download("facture de ".auth()->user()->name.".pdf");

        event(new BuyBillEvent(auth()->user(),$commande,$stream));

        session()->forget("cart");
        return redirect()->route("home")->with("message","l'email a ete envoye avec success");
        }else
            return redirect()->back();
    }
}
