<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\AccountActionNotification;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function update(Request $request,$id){
        $request->validate([
            "name" => ["required"],
            "ville" => "required",
            "tel"=>"required",
            "prenom"=>"required"
    ]);
        $res = User::query()->where("id","=",$id)->update($request->except("_token"));
        return redirect()->route("admin.client.index")->with("message.success","comptes modifier avec success");
    }

    function destroy(Request $request,$id){
        $user = User::query()->findOrFail($id);
        $user->commandes->each(function ($commande){
            $commande->delete();
        });
        if ($user->isAdminExist()){
            $user->admin->destroy();
        }
        $user->notify(new AccountActionNotification("votre compte a ete supprimer"));
        $user->destroy($id);
        return redirect()->route("admin.client.index")->with("message.success","compte supprime avec success");
    }

}
