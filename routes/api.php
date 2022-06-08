<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(ProductoController::class)->group(function (){
    Route::get("/productos/{pagina}", "index");
    Route::post('/productos', 'store');    
    Route::put('/productos/{id_producto}', 'update');    
    Route::delete('/productos/{id_producto}', 'destroy');    
    Route::get("/productos/obtener-uno/{id_producto}", "getProduct");
});

