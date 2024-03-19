<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluation extends Model
{
    protected $fillable = ['theEvaluation', 'cource_id'];

    use HasFactory;
}
