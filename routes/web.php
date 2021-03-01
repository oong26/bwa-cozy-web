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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::group(['prefix' => 'master'], function () {
        Route::resource('role', 'RoleController', ['names' => [
            'index' => 'role'
        ]]);
        Route::group(['prefix' => 'users'], function(){
            Route::resource('users', 'UsersController', ['names' => [
                'index' => 'users'
            ]]);
            Route::get('change-password/{id}', 'UsersController@changePassword')->name('change-password');
            Route::put('update-password/{id}', 'UsersController@updatePassword')->name('update-password');
        });
        Route::resource('city', 'CityController', ['names' => [
            'index' => 'city'
        ]]);
        Route::resource('country', 'CountryController', ['names' => [
            'index' => 'country'
        ]]);
        Route::resource('boarding-house', 'BoardingHouseController', ['names' => [
            'index' => 'boarding-house',
        ]]);
    });

});