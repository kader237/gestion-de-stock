<?php

use Inertia\Inertia;
use App\Models\Produit;
use Nette\Utils\Arrays;
use Nette\Utils\ArrayList;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProduitController;
use Barryvdh\DomPDF\PDF;
use Illuminate\View\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("/test",function(){
    dd(auth()->user()->admin()->exists());
});

Route::get('/', function () {
    return view('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name("home");

Route::get('/AdminDashboard', function () {

    return view('dashboard');

})->middleware(['auth', 'verified',"admin"])->name('dashboard');

Route::get("/ClientDashboard",function(){

    return Inertia::render("Dashboard");

})->name("ClientDashboard");

Route::get("/produit",function(){
    $produit = Produit::all();
    return view("produit",compact("produit"));
})->name("produit.index");

Route::post("produit/cart/{id}/delete",function($id){
    $cart = session("cart");
    $ncart=[];
    foreach(array_keys($cart) as $c){
        if($c!=$id){
            $ncart["$c"] = $cart["$c"];
        }
     }
     session()->remove("cart");
    session()->put("cart",$ncart);
    return redirect()->route("produit.cart.index");
})->name("produit.cart.delete");

Route::get("/produit/cart",[ProduitController::class,"cart"])->name("produit.cart.index");

Route::group(
    [
        "as"=>"admin.",
        "prefix"=> "admin",
        "middleware"=>["admin"]
    ]
    ,function () {

    Route::get("produit/create",function(){
        return view("admin.produit.create");
    })->name("produit.create");

    Route::get("produit/{id}/edit",function($id){
        $produit = Produit::findOrFail($id);
        return view("admin.produit.edit",compact("produit"));
    })->name("produit.edit")->whereNumber("id");

    Route::post("/produit/{id}/delete",[ProduitController::class,"destroy"])->name("produit.delete");
    Route::post("/produit/{id}/update",[ProduitController::class,"update"])->name("produit.update");
    Route::get("/produit",function(){
        $produit = Produit::all();
        return view("admin.produit.index",compact("produit"));
    })->name("produit.index")->middleware(["admin"]);

    Route::post('produit',[ProduitController::class,"store"])
                ->name("produit.store");

});

Route::get("/admin",function(){
    return view("admin");
})->name("admin.index");

Route::post("/produit/{id}/commander",[ProduitController::class,"commander"])->name("produit.commander")->middleware("auth");

require __DIR__.'/auth.php';
