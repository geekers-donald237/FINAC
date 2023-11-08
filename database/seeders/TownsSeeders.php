<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TownsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('towns')->delete();
        $cities = array (
            array('name' => "Banyo", 'state_id' => 1),
            array('name' => "Meiganga", 'state_id' => 1),
            array('name' => "Ngaoundere", 'state_id' => 1),
            array('name' => "Tibati", 'state_id' => 1),
            array('name' => "Tignere", 'state_id' => 1),
            array('name' => "Akonolinga", 'state_id' => 2),
            array('name' => "Bafia", 'state_id' => 2),
            array('name' => "Eseka", 'state_id' => 2),
            array('name' => "Mbalmayo", 'state_id' => 2),
            array('name' => "Mfou", 'state_id' => 2),
            array('name' => "Monatele", 'state_id' => 2),
            array('name' => "Nanga Eboko", 'state_id' => 2),
            array('name' => "Obala", 'state_id' => 2),
            array('name' => "Ombesa", 'state_id' => 2),
            array('name' => "Saa", 'state_id' => 2),
            array('name' => "Yaounde", 'state_id' => 2),
            array('name' => "Yaounde", 'state_id' => 2),
            array('name' => "Abong Mbang", 'state_id' => 3),
            array('name' => "Batouri", 'state_id' => 3),
            array('name' => "Bertoua", 'state_id' => 3),
            array('name' => "Betare Oya", 'state_id' => 3),
            array('name' => "Djoum", 'state_id' => 3),
            array('name' => "Doume", 'state_id' => 3),
            array('name' => "Lomie", 'state_id' => 3),
            array('name' => "Yokadouma", 'state_id' => 3),
            array('name' => "Bonaberi", 'state_id' => 4),
            array('name' => "Dibombari", 'state_id' => 4),
            array('name' => "Douala", 'state_id' => 4),
            array('name' => "Edea", 'state_id' => 4),
            array('name' => "Loum", 'state_id' => 4),
            array('name' => "Manjo", 'state_id' => 4),
            array('name' => "Mbanga", 'state_id' => 4),
            array('name' => "Nkongsamba", 'state_id' => 4),
            array('name' => "Yabassi", 'state_id' => 4),
            array('name' => "Figuif", 'state_id' => 5),
            array('name' => "Garoua", 'state_id' => 5),
            array('name' => "Guider", 'state_id' => 5),
            array('name' => "Lagdo", 'state_id' => 5),
            array('name' => "Poli", 'state_id' => 5),
            array('name' => "Rey Bouba", 'state_id' => 5),
            array('name' => "Tchollire", 'state_id' => 5),
            array('name' => "Figuif", 'state_id' => 6),
            array('name' => "Garoua", 'state_id' => 6),
            array('name' => "Guider", 'state_id' => 6),
            array('name' => "Lagdo", 'state_id' => 6),
            array('name' => "Poli", 'state_id' => 6),
            array('name' => "Rey Bouba", 'state_id' => 6),
            array('name' => "Tchollire", 'state_id' => 6),
            array('name' => "Bamenda", 'state_id' => 7),
            array('name' => "Kumbo", 'state_id' => 7),
            array('name' => "Mbengwi", 'state_id' => 7),
            array('name' => "Mme", 'state_id' => 7),
            array('name' => "Njinikom", 'state_id' => 7),
            array('name' => "Nkambe", 'state_id' => 7),
            array('name' => "Wum", 'state_id' => 7),
            array('name' => "Bafang", 'state_id' => 8),
            array('name' => "Bafoussam", 'state_id' => 8),
            array('name' => "Bafut", 'state_id' => 8),
            array('name' => "Bali", 'state_id' => 8),
            array('name' => "Bana", 'state_id' => 8),
            array('name' => "Bangangte", 'state_id' => 8),
            array('name' => "Djang", 'state_id' => 8),
            array('name' => "Fontem", 'state_id' => 8),
            array('name' => "Foumban", 'state_id' => 8),
            array('name' => "Foumbot", 'state_id' => 8),
            array('name' => "Mbouda", 'state_id' => 8),
            array('name' => "Akom", 'state_id' => 9),
            array('name' => "Ambam", 'state_id' => 9),
            array('name' => "Ebolowa", 'state_id' => 9),
            array('name' => "Kribi", 'state_id' => 9),
            array('name' => "Lolodorf", 'state_id' => 9),
            array('name' => "Moloundou", 'state_id' => 9),
            array('name' => "Mvangue", 'state_id' => 9),
            array('name' => "Sangmelima", 'state_id' => 9),
            array('name' => "Buea", 'state_id' => 10),
            array('name' => "Idenao", 'state_id' => 10),
            array('name' => "Kumba", 'state_id' => 10),
            array('name' => "Limbe", 'state_id' => 10),
            array('name' => "Mamfe", 'state_id' => 10),
            array('name' => "Muyuka", 'state_id' => 10),
            array('name' => "Tiko", 'state_id' => 10),

        );
        DB::table('towns')->insert($cities);


    }

}


