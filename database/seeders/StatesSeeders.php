<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->delete();
        $states = array(
            array('name' => "Adamaoua", 'country_id' => 37),
            array('name' => "Centre", 'country_id' => 37),
            array('name' => "Est", 'country_id' => 37),
            array('name' => "Littoral", 'country_id' => 37),
            array('name' => "Nord", 'country_id' => 37),
            array('name' => "Nord Extreme", 'country_id' => 37),
            array('name' => "Nordouest", 'country_id' => 37),
            array('name' => "Ouest", 'country_id' => 37),
            array('name' => "Sud", 'country_id' => 37),
            array('name' => "Sudouest", 'country_id' => 37),
        );
        DB::table('states')->insert($states);
    }
}


