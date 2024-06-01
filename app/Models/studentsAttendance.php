<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentsAttendance extends Model
{
    use HasFactory;
    
    protected $fillable=[
        "StudentCode",
        "Status",
        "attendedDay"
       
];
}
