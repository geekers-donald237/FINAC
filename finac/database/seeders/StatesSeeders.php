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
            array('id'=> 1, 'name' => "Adamaoua", 'country_id' => 1),
            array('id'=> 2, 'name' => "Centre", 'country_id' => 1),
            array('id'=> 3, 'name' => "Est", 'country_id' => 1),
            array('id'=> 4, 'name' => "Littoral", 'country_id' => 1),
            array('id'=> 5, 'name' => "Nord", 'country_id' => 1),
            array('id'=> 6, 'name' => "Nord Extreme", 'country_id' => 1),
            array('id'=> 7, 'name' => "Nordouest", 'country_id' => 1),
            array('id'=> 8, 'name' => "Ouest", 'country_id' => 1),
            array('id'=> 9, 'name' => "Sud", 'country_id' => 1),
            array('id'=> 10, 'name' => "Sudouest", 'country_id' => 1),
        );
        DB::table('states')->insert($states);
    }
}


