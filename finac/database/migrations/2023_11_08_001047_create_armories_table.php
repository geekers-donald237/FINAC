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
    public function up()
    {
        Schema::create('armories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('country_id');
            $table->string('departement_id');
            $table->string('name');
            $table->string('sector');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('mailbox');
            $table->string('phone_number');
            $table->enum('statut',['creer' ,'suspendu' , 'verifie'])->default('creer');
            $table->string('license',1000)->nullable(); //file for license
            $table->boolean('is_delete')->default(false);

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('departement_id')->references('id')->on('departements')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armories');
    }
};
