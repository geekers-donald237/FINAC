<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('declaration_armes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nom');
            $table->string('prenom');
            $table->string('photo'); // Vous pouvez ajuster cela en fonction de la façon dont vous stockez les photos (peut-être un lien vers un stockage externe).
            $table->string('adresse');
            $table->date('date');
            $table->text('circonstance');
            $table->string('numero_serie');
            $table->string('marque');
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
