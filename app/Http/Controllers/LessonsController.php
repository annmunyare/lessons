<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lesson;

class LessonsController extends Controller
{
    public function index(){
        return view('show_lessons');
    }
    public function save(){
   
    }
    public function update(){
   
    }
    public function get(){
        $lesson = Lesson::all();
        echo $lesson;
    }
    public function delete(Lesson $lesson){
      
        $lesson->delete();
        echo $lesson;
    }
    public function getSingle(Lesson $lesson){
       
        echo json_encode ($lesson);
    }
}