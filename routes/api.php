<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accommodations;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', [Accommodations::class, 'test']);

/* Traer todos los acommodations */
Route::get('/accomodation/all', [Accommodations::class, 'accomodations']);

/* Traer por id */
Route::get('/accomodation/{id}', [Accommodations::class, 'accomodation']);

/* Método POST */
Route::post('/accomodation', [Accommodations::class, 'createAccomodation']);

/* Método edit */
Route::put('/accomodation/{id}', [Accommodations::class, 'updateAccomodation']);

/* Método de eliminar */
Route::delete('/accomodation/{id}', [Accommodations::class, 'deleteAccomodation']);
