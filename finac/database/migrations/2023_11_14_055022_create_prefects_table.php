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
        Schema::create('prefects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('country_id');
            $table->string('departement_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mailbox');
            $table->string('phone_number');
            $table->boolean('is_delete')->default(false);

            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('departement_id')->references('id')->on('departements')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prefects');
    }
};
