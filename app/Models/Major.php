<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Major extends Model
{
    use HasFactory;

    protected $primaryKey = 'major_id';


    public function students()
    {
        return $this->hasMany(MjuStudent::class,'major_id');
    }
}

