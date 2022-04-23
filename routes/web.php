<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\loginController;

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

//Set Root Path to contacts
Route::redirect('/', '/contacts');

Route::get('/login', [loginController::class, 'login'])->name('login');
Route::post('/login', [loginController::class, 'authenticate']);

//List all contacts
Route::get('/contacts', [ContactController::class, 'index'])->name('index');

Route::middleware(['auth'])->group(function () {

    //Create Contact
    Route::get('/contact/create', [ContactController::class, 'create'])->name('create');
    Route::post('/contact', [ContactController::class, 'insert']);

    //Update Contact
    Route::get('/contact/{id}/edit', [ContactController::class, 'edit'])->name('edit');
    Route::put('/contact', [ContactController::class, 'update']);

    //Read Contact Details
    Route::get('/contact/{id}/info', [ContactController::class, 'read'])->name('info');

    //Delete contact
    Route::delete('/contact', [ContactController::class, 'delete']);
});
