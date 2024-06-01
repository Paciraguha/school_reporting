<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_levels', function (Blueprint $table) {
            $table->id();
            $table->string('levels')->enum(['Nusery','Primary','Secondary','TVET']);
            $table->timestamps();
        });

        $now = Carbon::now();
        DB::table('class_levels')->insert(
            array(
            ['levels' => 'Nusery', 'created_at' => $now, 'updated_at' => $now],
            ['levels' => 'Primary', 'created_at' => $now, 'updated_at' => $now],
            ['levels' => 'Secondary', 'created_at' =>$now, 'updated_at' => $now],
            ['levels' => 'TVET', 'created_at' => $now, 'updated_at' => $now],
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_levels');
    }
};
