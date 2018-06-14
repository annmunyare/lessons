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
Route::get('/', 'LessonsController@index');
Route::post('/saveLesson','LessonsController@save');
Route::post('/updateLesson', 'LessonsController@update');
Route::get('/getLesson', 'LessonsController@get');
Route::get('/deleteLesson/{lesson}', 'LessonsController@delete');
Route::get('/getSingleLesson/{lesson}', 'LessonsController@getSingle');

