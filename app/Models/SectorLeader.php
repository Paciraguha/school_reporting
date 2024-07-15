<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorLeader extends Model
{
    use HasFactory;
    protected $fillable=[
        "SectorId",
        "userId"
];
}
