<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

//List all contacts
Route::get('/contact', [ContactController::class, 'index']);

//Create Contact
Route::get('/contact/create', [ContactController::class, 'create']);
Route::post('/contact', [ContactController::class, 'insert']);

//Update Contact
Route::get('/contact/{id}/edit', [ContactController::class, 'edit']);
Route::put('/contact', [ContactController::class, 'update']);

//Read Contact Details
Route::get('/contact/{id}/info', [ContactController::class, 'read']);

//Delete contact
Route::delete('/contact', [ContactController::class, 'delete']);
