<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class HomeController extends Controller
{
    //

    public function dashboard(){

        $user_id = request()->user()->id;
        $data = new stdClass;
        $nb_commander = DB::table("commandes")->where("user_id","=",$user_id)->selectRaw(" count(*) as nb ")->first("nb");
        $data->nb_commandes = $nb_commander->nb;
        $total_price = DB::table("commandes")->selectRaw("SUM(prix) as prix")->where("user_id",$user_id)->first("prix")->prix;
        $data->total_price = $total_price?$total_price:0;
        $data2 = DB::table("commandes")->selectRaw("sum(prix) as prix ")->selectRaw(" month(created_at) as mois")->selectRaw("count(*) as nb")->groupByRaw("month(created_at) , user_id")->having("user_id","=",$user_id)->get();
        // je declare mon tabeau final de mois et je les initialise
        $tab_month = [];
        for($i=1;$i<=12;$i++){
            $tab_month[$i] = 0;
        }

        // je sauvegar mes mois dans un tableau
        $data2->each(function ($elt) use(&$tab_month) {
            $mois = $elt->mois;
            if(in_array($mois,array_keys($tab_month))){
                $tab_month[$mois] = $elt->prix;
            }
        });


        return view("dashboard",compact("data","data2","tab_month"));
    }
}
