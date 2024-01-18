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
        Schema::create('weapon_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('armory_id');
            $table->string('type');
            $table->string('description');
            $table->unsignedInteger('quantity')->default(0);
            $table->boolean('is_delete')->default(false);

            $table->timestamps();

            $table->foreign('armory_id')->references('id')->on('armories')->onDelete('cascade')->onUpdate('cascade'); // Clé étrangère vers la table Armories
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weapons_type');
    }
};
