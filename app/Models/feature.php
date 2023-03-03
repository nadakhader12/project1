<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class feature extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded=[];
    public function projects()
    {
        return $this->hasMany(project::class);
    }
}
