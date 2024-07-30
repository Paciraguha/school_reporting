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
        Schema::create('head_teachers', function (Blueprint $table) {
           $table->increments('id');;
            $table->integer('userId')->unsigned();
            $table->integer('SchoolId')->unsigned();
            $table->integer('teachingLevel')->default(0)->unsigned();
            $table->index('userId');
            $table->foreign('userId')->references('id')->on('users'); 
            $table->foreign('SchoolId')->references('id')->on('schools'); 
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('head_teachers');
    }
};
