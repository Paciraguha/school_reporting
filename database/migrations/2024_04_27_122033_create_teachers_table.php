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
        Schema::create('teachers', function (Blueprint $table) {
           $table->increments('id');;
            $table->string('Schoolcode')->nullable();
            $table->string('position')->nullable();
            $table->string('RepresentationClass')->nullable();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('email')->nullable();
            $table->string('Telephone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
