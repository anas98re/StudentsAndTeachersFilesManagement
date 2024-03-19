<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lecture extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'LinkForDownloade', 'subject_id'];

    public function subjects(){
        return $this->belongsTo(subject::class,'subject_id','id');
    }

    public function files(){
        return $this->hasMany(lectureFile::class,'lecture_id','id');
    }

    public function homeWorkes(){
        return $this->hasMany(homework::class,'lecture_id','id');
    }
}
