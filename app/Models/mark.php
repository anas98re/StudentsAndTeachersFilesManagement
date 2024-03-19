<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class mark extends Model
{
    use HasFactory,Notifiable;
    protected $fillable=['theMark','student_id','teacher_id','subject_id','semesterSession'];

    public function students(){
        return $this->belongsTo(student::class,'student_id','id');
    }
    public function subjects(){
        return $this->belongsTo(subject::class,'subject_id','id');
    }
}
