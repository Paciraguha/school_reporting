<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadTeacher extends Model
{
    use HasFactory;
    protected $fillable=[
        "userId",
        "SchoolId",
        "teachingLevel"
      
    ];
    
    public function teachers()
    {
      return $this->belongsTo(User::class, 'userId');
    }
   
}
