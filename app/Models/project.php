<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $fillable=['title','keyword','descrition','tool','supervisored','type','speailiazation','studentName','student_id','teacher_id'];
    public function students(){
        return $this->belongsTo(student::class,'student_id','id');
    }
}
