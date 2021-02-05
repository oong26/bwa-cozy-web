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
            'index' => 'role',
            // 'edit' => 'role.edit',
            // 'destroy' => 'role.destroy'
        ]]);
        Route::resource('users', 'UsersController', ['names' => [
            'index' => 'users'
        ]]);
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