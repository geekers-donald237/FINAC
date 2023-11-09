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
        Schema::create('holders_weapons', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('telephone');
            $table->string('email')->unique();
            $table->string('profession');
            $table->integer('age');
            $table->string('identity_number');
            $table->string('photo')->nullable();
            $table->string('NUI');
            $table->string('origin_proof');
            $table->unsignedBigInteger('id_user'); // reference to armory
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holders_weapons');
    }
};
