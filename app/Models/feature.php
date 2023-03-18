<?php

namespace App\Models;

use App\Models\project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class feature extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded=[];
    public function projects()
    {
        return $this->hasMany(project::class);
    }
}
