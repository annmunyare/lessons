<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lesson;

class LessonsController extends Controller
{
    public function index(){
        return view('show_lessons');
    }

    public function save(Request $request){
    
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required'
        ]);
       
        $lesson = new Lesson;
        $lesson ->name = $request->name;
        $lesson->description =  $request->description;
        $lesson->save();
   
    }

    public function update(Request $request){
        $id = $request->id;
        $lesson = Lesson::findOrFail($id);
        $lesson->name = $request->name;
        $lesson->description = $request->description;
        $lesson->save();
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