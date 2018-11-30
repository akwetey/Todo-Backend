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
// update api routes
Route::post('todo/post','TodoController@store');
Route::get('todos', 'TodoController@index');
Route::get('todo/{id}', 'TodoController@show');
Route::get('todo/edit/{id}','TodoController@edit');
Route::put('todo/update/{id}','TodoController@update');
Route::delete('todo/delete/{id}' , 'TodoController@destroy');

Route::middleware(['cors'])->group(function () {
	Route::get('/todo_list','TodoController@getList');
    Route::post('/save_todo','TodoController@saveTodo');

});
