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
        Schema::create('students_attendances', function (Blueprint $table) {
           $table->increments('id');;
            $table->string("StudentCode");
            $table->string("Status")->enum(['Present','Absent']);
            $table->string('attendedDay');
            $table->string('teacherComments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_attendances');
    }
};
