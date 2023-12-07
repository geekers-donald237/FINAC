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
        Schema::create('declarations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('finac_code');
            $table->string('series_number');
            $table->string('name');
            $table->string('surname');
            $table->date('dateNaissance');
            $table->string('lieuNaissance');
            $table->string('photoRecto')->nullable();
            $table->string('photoVerso')->nullable();
            $table->date('date');
            $table->string('adresse');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declarations');
    }
};
