<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'mobile', 'dob', 'address', 'gender'
    ];

    public function marks(){
        return $this->hasMany(Mark::class);
    }
}
