<?php

namespace Database\Seeders;

use App\Models\user\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GovernorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            "Adamaoua", "Centre", "Est", "Littoral", "Nord", "Nord Extrême", "Nord-Ouest", "Ouest", "Sud", "Sud-Ouest"
        ];

        foreach ($regions as $index => $region) {
            // Création du gouverneur
            $governorId = Str::uuid();
            DB::table('governors')->insert([
                'id' => $governorId,
                'country_id' => '1', // Assuming the country_id for Cameroon is 1
                'state_id' => $index + 1,
                'name' => $region . ' Governor',
                'email' => strtolower(str_replace(' ', '', $region)) . '@example.com',
                'mailbox' => 'P.O. Box ' . rand(100, 999),
                'phone_number' => '+237 6' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999),
                'is_delete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            // Création de l'utilisateur lié au gouverneur
            $user = new User();
            $user->id = Str::uuid();
            $user->generated_login = strtolower($region) . '_governor';
            $user->generated_password = Hash::make('password');
            $user->prefix = 'governor';
            $user->ressource_id = $governorId->toString();
            $user->save();
        }

    }
}
