<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable=[
        "SectorCode",
        "SchoolCode",
        "SchoolName",
        "SchoolLevels"
];

protected $casts = [
    'SchoolLevels' => 'array'
];


}
