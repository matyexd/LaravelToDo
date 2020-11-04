<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Получить список списков
Route::post('list_of_lists/get/', 'App\Http\Controllers\TodoListController@getListOfLists');

// CRUD со списками дел
Route::post('list_of_case/get/{id}', 'App\Http\Controllers\TodoListController@getListCases');
Route::post('list_of_case/create/', 'App\Http\Controllers\TodoListController@createList');
Route::put('list_of_case/edit/{id}', 'App\Http\Controllers\TodoListController@editList');
Route::delete('list_of_case/delete/{id}', 'App\Http\Controllers\TodoListController@deleteList');

// CRUD с делами
//Route::post('case/get/{id}', 'App\Http\Controllers\CaseItemController@getCase');
Route::put('case/edit/{id}', 'App\Http\Controllers\CaseItemController@editCase');
Route::delete('case/delete/{id}', 'App\Http\Controllers\CaseItemController@deleteCase');
Route::post('case/create/', 'App\Http\Controllers\CaseItemController@createCase');

// Пометить дело как сделанное
Route::get('case/mark-done/{id}', 'App\Http\Controllers\CaseItemController@markDoneCase');


Route::group(['middleware' => 'auth:api'], function() {
    Route::post('case/get/{id}', 'App\Http\Controllers\CaseItemController@getCase');
    Route::post('user', 'App\Http\Controllers\UserController@user');

});

Route::post('login', 'App\Http\Controllers\UserController@login');
Route::post('register', 'App\Http\Controllers\UserController@register');
