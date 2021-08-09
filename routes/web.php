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

Route::get('/', function () {
  return view('user.Acceuille');
 
});
Auth::routes(); 
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/modif', 'HomeController@index1')->name('home');

Route::get('Catégo_Prod', 'CategorieController@index')->name('Catégo_Prod');
Route::resource('UtilisateurFiles', 'SignaleController');
Route::resource('ProduitFiles','ProduitController');
Route::resource('StocksFiles','StatistiqueController');
Route::get('publicationDossier/{id}/edit/','PublicationController@edit');
Route::get('StatistiqueFiles/{id}/edit/','StatistiqueController@edit');












Route::resource('user','AcceuilleController');
