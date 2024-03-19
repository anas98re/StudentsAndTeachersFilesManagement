<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class homeWorkFiles extends Model
{
    use HasFactory;
    protected $fillable=['name','LinkForDownloade','student_id','homeWork_id'];

}
