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
        Schema::create('ammunitions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('armory_id');

            $table->string('name');
            $table->string('type');
            $table->string('caliber');
            $table->integer('quantity_in_stock');
            $table->boolean('is_delete')->default(false);
            $table->foreign('armory_id')->references('id')->on('armories')->onDelete('cascade')->onUpdate('cascade'); // Clé étrangère vers la table Armories

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ammunitions');
    }
};
