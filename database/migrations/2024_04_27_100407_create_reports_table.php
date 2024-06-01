<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_reports', function (Blueprint $table) {
           $table->increments('id');;
            $table->string('ReportingDate')->nullable();
            $table->string('SectorCode')->nullable();
            $table->string('SchoolCode')->nullable();
            $table->integer('NurseryExpectedBoy')->nullable();
            $table->integer('NurseryExpectedGirl')->nullable();
            $table->integer('NurseryExpectedTotal')->nullable();
            $table->integer('NurseryAttendedBoy')->nullable();
            $table->integer('NurseryAttendedGirl')->nullable();
            $table->integer('NurseryAttendedTotal')->nullable();
            $table->integer('NurseryPercentage')->nullable();
            $table->integer('PrimaryExpectedBoy')->nullable();
            $table->integer('PrimaryExpectedGirl')->nullable();
            $table->integer('PrimaryExpectedTotal')->nullable();
            $table->integer('PrimaryAttendedBoy')->nullable();
            $table->integer('PrimaryAttendedGirl')->nullable();
            $table->integer('PrimaryAttendedTotal')->nullable();
            $table->integer('PrimaryPercentage')->nullable();
            $table->integer('OlevelExpectedBoy')->nullable();
            $table->integer('OlevelExpectedGirl')->nullable();
            $table->integer('OlevelExpectedTotal')->nullable();
            $table->integer('OlevelAttendedBoy')->nullable();
            $table->integer('OlevelAttendedGirl')->nullable();
            $table->integer('OlevelAttendedTotal')->nullable();
            $table->integer('OlevelPercentage')->nullable();
            $table->integer('AlevelExpectedBoy')->nullable();
            $table->integer('AlevelExpectedGirl')->nullable();
            $table->integer('AlevelExpectedTotal')->nullable();
            $table->integer('AlevelAttendedBoy')->nullable();
            $table->integer('AlevelAttendedGirl')->nullable();
            $table->integer('AlevelAttendedTotal')->nullable();
            $table->integer('AlevelPercentage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_reports');
    }
};
