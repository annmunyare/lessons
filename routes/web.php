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
    return view('show_lessons');
});

Route::get('/saveLesson', function () {
    
});
Route::get('/updateLesson', function () {
    
});
Route::get('/deleteLesson/{id}', function ($id) {
   DB::table("lesson")->where('id', $id)->delete();
   $lesson = DB::table("lesson")->get();
   echo $lesson;
});


Route::get('/getLesson', function () {
    $lesson = DB::table("lesson")->get();
    echo $lesson;
});

Route::get('/getSingleLesson/{lesson}', function ($id) {
    $lesson = DB::table("lesson")->find($id);
    echo  json_encode($lesson);
});


