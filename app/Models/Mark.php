<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
      'mark1', 'mark2', 'mark3', 'mark4', 'mark5', 'user_id'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
