<?php

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


Route::redirect('/', '/login');

Auth::routes();

Route::group(['middleware'=>'auth'],function(){

    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::get('/registre','Auth\RegisterController@userListe')->name('registre');

    Route::post('/registreUpdate/{iduser}','Auth\RegisterController@userUpdate')->name('userUpdate');

    Route::get('/registreDelete/{iduser}','Auth\RegisterController@userDelete')->name('userDelete');

    Route::get('/registre/{iduser}','Auth\RegisterController@userEdit')->name('userEdit');


});