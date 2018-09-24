<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Unit;

class LecturersController extends Controller
{
    //
        public function show($units_id)
    {   
        $unit = Unit::findOrFail($units_id);
        $lecturers = $unit->lecturer;
       echo $lecturers;
        
       
       
    }

}
