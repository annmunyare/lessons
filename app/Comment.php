<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // public function archives()
    // {
    //     $comment = Comment::selectRaw('year(created_at) year, monthname(created_at) month, count(*) Published')-> 
    //     groupBy('year','month')->orderBy('created_at')->get();

    //     echo $comment;
    // }

    public static function   archives()
    
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) Published')-> 
        groupBy('year','month')->orderBy('created_at')->get()->toArray();

        // echo $lesson;
    

    }
}
