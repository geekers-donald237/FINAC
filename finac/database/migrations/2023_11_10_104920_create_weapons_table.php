<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weapons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('weapon_type_id');
            $table->string('holder_id');
            $table->string('serial_number');
            $table->timestamps();
            $table->foreign('holder_id')->references('id')->on('holders_weapons');
            $table->foreign('weapon_type_id')->references('id')->on('weapon_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weapons');
    }
};
