<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Unit;

class UnitsController extends Controller
{
    //
      public function store( Lesson $lesson)
      {
          Unit::create([
              'name'=>request('name'),
              'hours'=>request('hours'),
              'id'=>request('id')
          ]);
            return back();
      }
    // public function getSingle(Lesson $lesson)
    // {
       
    //     echo json_encode ($lesson);
    // }

    public function show($lesson_id)
    {   
        $lesson = Lesson::findOrFail($lesson_id);
        $units = $lesson->unit;
       echo $units;
        
       
       
    }

}
