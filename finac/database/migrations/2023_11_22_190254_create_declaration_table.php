<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('declarations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('finac_code');
            $table->string('series_number');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('declarations');;
    }
};