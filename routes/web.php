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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/requirements', function () {
    return view('requirements');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/**
 * Display All Tasks
 */
Route::get('/tasks', "TaskController@index")->name('tasks');

/**
 * Add A New Task
 */
Route::post('/task', "TaskController@store")->middleware('auth')->name('store_task');

/**
 * Update A Task
 */
Route::put('/task/{task}', "TaskController@update")->middleware('auth')->name('update_task');

/**
 * Delete An Existing Task
 */
Route::delete('/task/{task}', "TaskController@destroy")->middleware('auth')->name('delete_task');;