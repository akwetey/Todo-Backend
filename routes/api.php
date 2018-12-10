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
// get api resources
Route::resource('/todo','TodoController', [
	'except' =>['edit','show']
]);


Route::middleware(['cors'])->group(function () {
	Route::get('/todo_list','TodoController@getList');
	Route::post('/save_todo','TodoController@saveTodo');
	Route::post('/delete_todo','TodoController@deleteTodo');
	Route::post('/complete_todo','TodoController@completeTodo');
	Route::post('/update_todo','TodoController@updateTodo');

});
