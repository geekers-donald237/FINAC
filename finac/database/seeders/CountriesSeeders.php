<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CountriesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->delete();
        $countries = array(
            array('id' => 1,'code' => 'CM','name' => "Cameroon",'phonecode' => 237),
        );
        DB::table('countries')->insert($countries);

    }
}
