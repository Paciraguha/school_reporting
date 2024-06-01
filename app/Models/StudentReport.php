<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReport extends Model
{
    use HasFactory;
    protected $fillable=[
            "NurseryExpectedBoy",
            "NurseryExpectedGirl",
            "NurseryExpectedTotal",
            "NurseryAttendedBoy",
            "NurseryAttendedGirl",
            "NurseryAttendedTotal",
            "NurseryPercentage",
            "PrimaryExpectedBoy",
            "PrimaryExpectedGirl",
            "PrimaryExpectedTotal",
            "PrimaryAttendedBoy",
            "PrimaryAttendedGirl",
            "PrimaryAttendedTotal",
            "PrimaryPercentage",
            "OlevelExpectedBoy",
            "OlevelExpectedGirl",
            "OlevelExpectedTotal",
            "OlevelAttendedBoy",
            "OlevelAttendedGirl",
            "OlevelAttendedTotal",
            "OlevelPercentage",
            "AlevelExpectedBoy",
            "AlevelExpectedGirl",
            "AlevelExpectedTotal",
            "AlevelAttendedBoy",
            "AlevelAttendedGirl",
            "AlevelAttendedTotal",
            "AlevelPercentage"
    ];
}
