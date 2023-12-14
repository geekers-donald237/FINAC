<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountriesSeeders::class);
        $this->call(StatesSeeders::class);
        $this->call(AdminsSeeder::class);
        $this->call(MinatdSeeder::class);
        $this->call(DepartementSeeders::class);
        $this->call(DistrictsSeeders::class);
        $this->call(GovernorSeeder::class);
        $this->call(PrefectureSeeder::class);
        $this->call(    ArmorySeeder::class);
    }
}
