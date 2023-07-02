<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//* Controllers
use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\SubdivisionController;

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
// * Example
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

// * Ambassador routes
Route::get('/ambassador', [AmbassadorController::class, 'index']);
Route::get('/ambassador/{id}', [AmbassadorController::class, 'show']);
Route::post('/ambassador', [AmbassadorController::class, 'store']);
Route::put('/ambassador/{id}', [AmbassadorController::class, 'update']);
Route::delete('/ambassador/{id}', [AmbassadorController::class, 'delete']);

// * Division routes
Route::get('/division', [DivisionController::class, 'index']);
Route::get('/division/{id}', [DivisionController::class, 'show']);
Route::post('/division', [DivisionController::class, 'store']);
Route::put('/division/{id}', [DivisionController::class, 'update']);
Route::delete('/division/{id}', [DivisionController::class, 'delete']);

// * Subdivision routes
Route::get('/subdivision', [SubdivisionController::class, 'index']);
Route::get('/subdivision/{id}', [SubdivisionController::class, 'show']);
Route::post('/subdivision', [SubdivisionController::class, 'store']);
Route::put('/subdivision/{id}', [SubdivisionController::class, 'update']);
Route::delete('/subdivision/{id}', [SubdivisionController::class, 'delete']);