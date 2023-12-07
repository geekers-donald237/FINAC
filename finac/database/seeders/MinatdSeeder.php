<?php

namespace Database\Seeders;

use App\Models\user\subAdmin\Minatd;
use App\Models\user\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class MinatdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = Uuid::uuid4()->toString();
        $minatd = Minatd::create([
            'id' => $id,
            'name' => 'service central',
            'email' => 'minatd@example.com',
            'mailbox' => '854d7',
            'phone_number' => '657150979',
        ]);

        // Seed pour la table users liée
        $user = User::create([
            'id' => Uuid::uuid4()->toString(),
            'ressource_id' => $id,
            'generated_login' => 'minatd',
            'prefix' => 'minatd',
            'generated_password' => Hash::make('minatd'),
        ]);
    }
}
