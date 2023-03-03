<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class process extends Model
{
    use HasFactory , SoftDeletes;
   // protected $guraded=[];
   protected $fillable=['title','image','content'];
}
