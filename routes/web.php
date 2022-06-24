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


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get("/produit",function(){
    $produit = Produit::all();
    return view("produit",compact("produit"));
});
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
Route::prefix('admin')->group(function () {

    Route::get("produit/create",function(){
        return view("admin.produit.create");
    })->name("admin.produit.create");

    Route::get("produit/{id}/edit",function($id){
        $produit = Produit::findOrFail($id);
        return view("admin.produit.edit",compact("produit"));
    })->name("admin.produit.edit")->whereNumber("id");

    Route::post("/produit/{id}/delete",[ProduitController::class,"destroy"])->name("admin.produit.delete");
    Route::post("/produit/{id}/update",[ProduitController::class,"update"])->name("admin.produit.update");
    Route::any("/produit/{id}/commander",[ProduitController::class,"commander"])->name("produit.commander")->middleware("auth");
    Route::get("/produit",function(){
        $produit = Produit::all();
        return view("admin.produit.index",compact("produit"));
    })->name("admin.produit.index");
    Route::post('produit',[ProduitController::class,"store"])
                ->name("admin.produit.store");

});
Route::get("/admin",function(){
    return view("admin");
})->name("admin.index");

require __DIR__.'/auth.php';
