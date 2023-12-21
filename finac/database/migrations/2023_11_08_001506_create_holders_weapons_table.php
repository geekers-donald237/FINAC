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
        Schema::create('holders_weapons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('fullname');
            $table->string('telephone');
            $table->string('email');
            $table->string('profession');
            $table->string('identity_number',1000)->nullable();
            $table->string('buy_permission',1000)->nullable();
            $table->string('honor_contract',1000)->nullable();
            $table->string('photo',1000)->nullable();
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
