<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'year', 'techer_id'];

    public function lectures(){
        return $this->hasMany(lecture::class,'subject_id','id');
    }
    public function teacher(){
        return $this->belongsTo(teacher::class,'techer_id','id');
    }
}
