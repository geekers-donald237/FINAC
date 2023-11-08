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
        Schema::create('armories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_country');
            $table->unsignedBigInteger('id_states');
            $table->unsignedBigInteger('id_town');
            $table->unsignedBigInteger('id_user');
            $table->string('name');
            $table->string('sector');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('mailbox');
            $table->string('phone_number');
            $table->string('agrement_number')->nullable();
            $table->string('licence',1000)->nullable(); //file for license

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_country')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_states')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_town')->references('id')->on('towns')->onDelete('cascade')->onUpdate('cascade');
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
