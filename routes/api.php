<?php

use Illuminate\Http\Request;

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
// updated api routes
Route::post('todos','TodoController@store');
Route::get('todos', 'TodoController@index');
Route::get('todos/{id}', 'TodoController@show');
Route::put('todos/{id}','TodoController@update');
Route::delete('todos/{id}','TodoController@destroy');
//Route::post('todos', 'TodoController@create');

Route::middleware(['cors'])->group(function () {
	Route::get('/todo_list','TodoController@getList');
    Route::post('/save_todo','TodoController@saveTodo');

});
