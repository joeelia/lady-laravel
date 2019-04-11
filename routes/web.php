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

Route::get('/', 'ClientReserved@index');
Route::get('clients', 'ClientReserved@clients');
Route::get('clients/waiting', 'ClientReserved@clientsWaiting');
Route::post('client/reserved', 'ClientReserved@clientReserved');
Route::get('client/called/{id}', 'ClientReserved@wasCalled');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('chart', 'SaleController@testChart');
Route::get('analytics/{startdate}/{enddate}', 'SaleController@analytics');