<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [TodoController::class, "index"]);
Route::post('/', [TodoController::class, "store"]);
Route::put('/{todo}', [TodoController::class, "modifiedData"]);
Route::patch('/{todo}', [TodoController::class, "update"]);
Route::delete('/{todo}', [TodoController::class, "remove"]);
Route::post('/{todo}', [TodoController::class, "index"]);
