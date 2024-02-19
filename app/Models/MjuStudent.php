<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MjuStudent extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_code';

    public function major()
    {
        return $this->belongsTo(Major::class,'major_id');
    }

    protected $fillable = [
        'student_code',
        'first_name',
        'first_name_en' ,
        'major_id' ,
        'id_card',
        'gender',
        'birthdate',
        'address',
        'phone' ,
        'email',
    ];

}
