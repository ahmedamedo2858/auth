<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
Config::set('auth.defines','admin');
//Route::post('/','Admincontroller@dologin');
Route::post('login','Admincontroller@dologin')->name('dash.login');
Route::get('login','Admincontroller@login')->name('dash.dash');
Route::get('/','Admincontroller@login');
Route::get('rest/password','Admincontroller@GoRestPassword')->name('dash.rest');
Route::post('rest/password','Admincontroller@RestPassword');

//DashBord
Route::group(['middleware'=>'admin:admin'],function (){
    Route::get('/home','Admincontroller@DashBord')->name('dash.home');
    Route::resource('control','AdminDataTablesController');
    Route::get('/logout','Admincontroller@logout')->name('dash.logout');
});




