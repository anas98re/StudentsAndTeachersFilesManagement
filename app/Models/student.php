<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $fillable=['name','gpa','speailiazation','phoneNumber','user_id','rate'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function marks(){
        return $this->hasMany(mark::class,'student_id','id');
    }
}
