<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = ['username', 'password', 'full_name', 'grade'];

    protected $hidden = ['password'];

    public function periods()
    {
        return $this->belongsToMany(Period::class, 'student_period');
    }
}
