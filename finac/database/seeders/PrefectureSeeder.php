<?php

namespace Database\Seeders;

use App\Models\user\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PrefectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ["name" => "BUI", "departement_id" => 34],
            ["name" => "FARO & DEO", "departement_id" => 2],
            ["name" => "HAUTE-SANAGA", "departement_id" => 6],
            ["name" => "LEKIE", "departement_id" => 7],
            ["name" => "BOUMBA ET NGOKO", "departement_id" => 16],
            ["name" => "HAUT NYONG", "departement_id" => 17],
            ["name" => "MOUNGO", "departement_id" => 20],
            ["name" => "SANAGA MARITIME", "departement_id" => 22],
        ];

        foreach ($departments as $department) {
            // Création du département
            $departmentId = Str::uuid();
            DB::table('prefects')->insert([
                'id' => $departmentId,
                'country_id' => '1' ,
                'departement_id' => $department['departement_id'],
                'name' => $department['name'],
                'email' => strtolower(str_replace(' ', '', $department['name'])) . '@example.com',
                'mailbox' => 'P.O. Box ' . rand(100, 999),
                'phone_number' => '+237 6' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999),
                'is_delete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Création de l'utilisateur lié au département
            $user = new User();
            $user->id = Str::uuid();
            $user->generated_login = strtolower(str_replace(' ', '', $department['name'])) . '_department'; // Utilisation du nom du département pour générer le login
            $user->generated_password = Hash::make('password'); // Vous devriez générer un mot de passe sécurisé
            $user->prefix = 'prefecture';
            $user->ressource_id = $departmentId->toString();
            $user->save();
        }

    }
}
