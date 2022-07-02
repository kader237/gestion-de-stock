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

     $data2 = DB::table("commandes")->selectRaw("sum(prix) as prix  ")->selectRaw("count(*)")->groupByRaw("month(created_at) , user_id")->having("user_id","=",$user_id)->first();
     dd($data2);
     return view("dashboard",compact("data"));
    }
}
