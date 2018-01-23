<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'TodoList\Main@index');
Route::get('/list', 'TodoList\ListData@json_data');

Route::group(['prefix' => 'proses/todo/'], function () {
    Route::get('validtodo', 'TodoList\Action@validTodo');
    Route::post('save', 'TodoList\Action@save');
    Route::delete('remove', 'TodoList\Action@remove');
});
