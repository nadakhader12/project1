<?php

namespace App\Models;

use App\Models\feature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class project extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded=[];
    public function service()
    {
       return $this->belongTo(feature::class )->withDefault();
    }
}
