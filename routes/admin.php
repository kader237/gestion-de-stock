<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        "as"=>"admin.",
        "prefix"=> "admin",
        "middleware"=>["admin"]
    ]
    ,function () {

    Route::get("client/{id}/edit",function($id){
        $user = User::findOrFail($id);
        return view("admin.client.edit",compact("user"));
    })->name("client.edit")->whereNumber("id");

    Route::post("/client/{id}/delete",[UserController::class,"destroy"])->name("client.delete");

    Route::post("/client/{id}/update",[UserController::class,"update"])->name("client.update");

    Route::get("/client",function(){
        $user = User::query()->whereDoesntHave("admin")->get();
        $admin = User::query()->whereHas("admin")->get();
        return view("admin.client.index",compact("user","admin"));
    })->name("client.index")->middleware(["admin"]);

    Route::get("/admin/create",[AdminController::class,"create"])->name("admin.create");
    Route::post("/admin",[AdminController::class,"store"])->name("admin.store");
    Route::post('client',[ProduitController::class,"store"])->name("client.store");

});
