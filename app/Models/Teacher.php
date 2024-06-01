<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable=[
        "Schoolcode",
        "position",
        "RepresentationClass",
        "FirstName",
        "LastName",
        "email",
        "Telephone"  
];
}
