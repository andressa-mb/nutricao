<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('welcomeAuth');
})->name('main-page')->middleware('auth');

//Route::get('/home', 'HomeController@index')->name('main-page');

//USER
Route::get('/my-data', 'Users\UserController@show')->name('my-data');
Route::get('/edit-user/{user}', 'Users\UserController@edit')->name('edit-user');
Route::put('/update-user/{user}', 'Users\UserController@update')->name('update-user');
Route::delete('/delete-user/{user}', 'Users\UserController@destroy')->name('delete-user');
//SENHA
Route::get('/confirm-pass-form', 'Users\UserController@confirmPassForm')->name('confirm-pass-form');
Route::post('/confirm-pass', 'Users\UserController@confirm')->name('password.confirm'); //padrão laravel
Route::get('/change-pass', 'Users\UserController@changePasswordForm')->name('password-change-form');
Route::post('/update-pass', 'Users\UserController@updatePassword')->name('password-update-user-logged');
//ADMIN
Route::get('/users', 'Users\UserController@index')->name('users');

//FOOD
//TODOS USUÁRIOS
Route::get('/list-foods', 'Foods\FoodController@listFoods')->name('list-foods');
Route::post('/favorite-foods', 'Foods\FoodController@storeFavoriteFood')->name('save-favorite-foods');
Route::get('/my-favorite-foods', 'Foods\FoodController@myFavoriteFoods')->name('my-favorite-foods');
Route::delete('/{foodId}/delete-favorite', 'Foods\FoodController@destroyFavoriteFood')->name('delete-favorite');
//SOMENTE ADMIN
//Route::get('/foods', 'Foods\FoodController@index')->name('foods');
Route::get('/create-food', 'Foods\FoodController@create')->name('create-food');
Route::post('/save-food', 'Foods\FoodController@store')->name('save-food');
Route::get('/{foodId}/edit-food', 'Foods\FoodController@edit')->name('edit-food');
Route::put('/{foodId}/update-food', 'Foods\FoodController@update')->name('update-food');
Route::delete('/{foodId}/delete-food', 'Foods\FoodController@destroy')->name('delete-food');

//PROFILE
Route::get('/my-body-profile', 'Profiles\ProfileController@index')->name('my-body-profile');
Route::get('/create/profile', 'Profiles\ProfileController@create')->name('create-profile');
Route::post('/save/profile', 'Profiles\ProfileController@store')->name('save-profile');
Route::delete('/delete/profile', 'Profiles\ProfileController@destroy')->name('delete-profile');

//PROFILE EVOLUTION
Route::get('/new-measures', 'Profiles\ProfileController@createProfileEvolution')->name('new-measures');
Route::post('/save/new-measures', 'Profiles\ProfileController@storeProfileEvolution')->name('save-measures');
Route::delete('/delete/profile-evolution/{evolution}', 'Profiles\ProfileController@destroyEvolution')->name('delete-profile-evolution');
