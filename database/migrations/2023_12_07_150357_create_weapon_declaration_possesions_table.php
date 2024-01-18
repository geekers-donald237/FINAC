<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weapon_declaration_possesions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('fullname');
            $table->string('phone_number');
            $table->string('email');
            $table->string('adress');
            $table->string('serial_number');
            $table->string('weapon_type');
            $table->text('circumstances');
            $table->string('weapon_picture')->nullable();
            $table->string('cni')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaration_armes');
    }
};
