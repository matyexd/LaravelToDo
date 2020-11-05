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




Route::group(['middleware' => 'auth:api'], function() {

    // Получить список списков
    Route::post('list_of_lists/get', 'App\Http\Controllers\TodoListController@getListOfLists');

    // CRUD со списками дел
    Route::post('list_of_case/get/{id}', 'App\Http\Controllers\TodoListController@getListCases');
    Route::post('list_of_case/create/', 'App\Http\Controllers\TodoListController@create');
    Route::put('list_of_case/edit/{id}', 'App\Http\Controllers\TodoListController@edit');
    Route::delete('list_of_case/delete/{id}', 'App\Http\Controllers\TodoListController@delete');

    // CRUD с делами
    Route::put('case/edit/{id}', 'App\Http\Controllers\CaseItemController@edit');
    Route::delete('case/delete/{id}', 'App\Http\Controllers\CaseItemController@delete');
    Route::post('case/create/', 'App\Http\Controllers\CaseItemController@create');
    Route::post('case/get/{id}', 'App\Http\Controllers\CaseItemController@get');

    // Пометить дело как сделанное
    Route::put('case/mark-done/{id}', 'App\Http\Controllers\CaseItemController@markDone');

    Route::post('user', 'App\Http\Controllers\UserController@user');

});

Route::post('login', 'App\Http\Controllers\UserController@login');
Route::post('register', 'App\Http\Controllers\UserController@register');
