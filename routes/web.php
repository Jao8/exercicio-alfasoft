<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/contacts', 'ContactController@index');

//Create Contact
Route::get('/contact/create', 'ContactController@create');
Route::post('/contact', 'ContactController@insert');

//Update Contact
Route::get('/contact/{id}/edit', 'ContactController@edit');
Route::put('/contact', 'ContactController@update');

//Read Contact Details
Route::get('/contact/{id}/info', 'ContactController@read');

//Delete contact
Route::delete('/contact', 'ContactController@delete');
