<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable=[
        'StudentCode',
        'SchoolCode',
        'ClassLevel',
        'ClassSection',
        'FirstName',
        'LastName',
        'Gender'
];
}
