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
        Schema::create('permissions_ports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('weapon_id');
            $table->string('holder_id');
            $table->string('validate_from_id')->nullable();
            $table->date('date_demande');
            $table->enum('statut',['envoye' , 'rejete' ,'accepte']);
            $table->string('motif_refus')->nullable();
            $table->string('code_finac')->unique()->nullable();
            $table->string('numero_serie')->unique()->nullable();
            $table->timestamps();

            $table->foreign('weapon_id')->references('id')->on('weapons')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('holder_id')->references('id')->on('holders_weapons')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions_ports');
    }
};
