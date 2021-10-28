<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = ['username', 'password', 'full_name', 'email'];

    protected $hidden = ['password'];

    public function periods()
    {
        return $this->hasMany(Period::class);
    }
}
