<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function create(){
        $user = User::query()->whereDoesntHave("admin")->get();
        return view("admin.admin.create",compact("user"));
    }
    function store(Request $request){
        $request->validate([
            "user_id"=>["required","integer"],
            "type"=>["required","string"]
        ]);

        $res = Personnel::query()->create($request->except("_token"));
        return redirect()->route("admin.client.index")->with("message.success","administrateur cree avec success");

    }
}
