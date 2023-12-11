<?php

namespace Database\Seeders;

use App\Models\armory\HoldersWeapon;
use App\Models\PermissionsPort;
use App\Models\user\User;
use App\Models\weapons\Weapon;
use App\Models\weapons\WeaponType;
use Faker\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ArmorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = FakerFactory::create();

        foreach (range(1, 5) as $index) {
            $armoryId = Str::uuid();
            $userId = Str::uuid();

            // Création de l'armurerie
            $armory = [
                'id' => $armoryId,
                'country_id' => '37',
                'departement_id' => $faker->numberBetween(1, 5),
                'name' => 'sos',
                'sector' => $faker->word . ' Sector',
                'address' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'mailbox' => 'P.O. Box ' . rand(100, 999),
                'phone_number' => '+237 6' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999),
                'agrement_number' => 'AG' . rand(100, 999),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('armories')->insert($armory);

            // Création de l'utilisateur lié à l'armurerie
            $user = new User();
            $user->id = $userId;
            $user->generated_login = strtolower(str_replace(' ', '', $armory['name'])) . '_armory';
            $user->generated_password = bcrypt('password'); // Vous devriez générer un mot de passe sécurisé
            $user->prefix = 'armory';
            $user->ressource_id = $armoryId->toString();
            $user->save();

            // Création des types d'armes
            $weaponTypes = [
                ['type' => 'Pistolet', 'quantity' => 10, 'description' => 'Arme de poing'],
                ['type' => 'Fusil d\'assaut', 'quantity' => 5, 'description' => 'Arme automatique'],
                ['type' => 'Fusil de chasse', 'quantity' => 8, 'description' => 'Arme pour la chasse'],
                ['type' => 'Mitrailleuse', 'quantity' => 3, 'description' => 'Arme automatique à tir rapide'],
                ['type' => 'Sniper', 'quantity' => 2, 'description' => 'Arme de précision'],
            ];

            foreach ($weaponTypes as $weaponType) {
                $weaponTypeId = Str::uuid();
                $weaponType['id'] = $weaponTypeId;
                $weaponType['armory_id'] = $armoryId->toString();
                WeaponType::create($weaponType);

                // Création des armes
                $weapons = [];
                for ($i = 0; $i < $weaponType['quantity']; $i++) {
                    $weaponId = Str::uuid();
                    $weapons[] = [
                        'id' => $weaponId,
                        'weapon_type_id' => $weaponTypeId->toString(),
                        'serial_number' => 'SN' . rand(1000, 9999),
                        'holder_id' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                Weapon::insert($weapons);
            }

            // Création des détenteurs
            $holders = [];
            for ($i = 0; $i < 3; $i++) {
                $holderId = Str::uuid();
                DB::table('holders_weapons')->insert([
                    'id' => $holderId,
                    'fullname' => $faker->name,
                    'telephone' => $faker->phoneNumber,
                    'email' => $faker->safeEmail,
                    'profession' => $faker->word,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $holders[] = $holderId;
            }

            // Lier chaque détenteur à une arme et effectuer des demandes de permission de port
            foreach ($holders as $holderId) {
                $randomWeapon = Weapon::inRandomOrder()->first();
                $randomWeapon->holder_id = $holderId->toString();
                $randomWeapon->save();

                // Création de la demande de permission de port
                $permissionPort = new PermissionsPort();
                $permissionPort->id = Str::uuid();
                $permissionPort->holder_id = $holderId->toString();
                $permissionPort->weapon_id = $randomWeapon->id;
                $permissionPort->date_demande = now();
                $permissionPort->save();
            }
        }
    }

}
