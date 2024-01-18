<?php

namespace Database\Seeders;

use App\Models\user\AdminSytem;
use App\Models\user\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = Uuid::uuid4()->toString();
        $adminSystem = AdminSytem::create([
            'id'=> $id,
            'nom' => 'admin',
            'email' => 'admin@gmail.com',
        ]);

        // Seed pour la table users liée
        $user = User::create([
            'id' => Uuid::uuid4()->toString(),
            'ressource_id' => $id,
            'generated_login' => 'admin',
            'prefix' => 'admin',
            'generated_password' => Hash::make('admin'),
        ]);
    }
}
