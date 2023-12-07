<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class DepartementSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departements')->delete();
        $departemnts = array (
            array('id' => 1, 'name' => "DJEREM", 'state_id' => 1),
            array('id' => 2, 'name' => "FARO & DEO", 'state_id' => 1),
            array('id' => 3, 'name' => "MANYO BANYO", 'state_id' => 1),
            array('id' => 4, 'name' => "MBERE", 'state_id' => 1),
            array('id' => 5, 'name' => "VINA", 'state_id' => 1),

            array('id' => 6, 'name' => "HAUTE-SANAGA", 'state_id' => 2),
            array('id' => 7, 'name' => "LEKIE", 'state_id' => 2),
            array('id' => 8, 'name' => "MBAM & INOUBOU", 'state_id' => 2),
            array('id' => 9,'name' => "MBAM & KIM", 'state_id' => 2),
            array('id' => 10,'name' => "MEFOU & AFAMBA ", 'state_id' => 2),
            array('id' => 11,'name' => "MEFOU ET AKONO", 'state_id' => 2),
            array('id' => 12,'name' => "MFOUNDI", 'state_id' => 2),
            array('id' => 13,'name' => "NYONG EKELLE", 'state_id' => 2),
            array('id' => 14,'name' => "NYONG & MFOUMOU", 'state_id' => 2),
            array('id' => 15, 'name' => "NYONG & SO'O", 'state_id' => 2),

            array('id' => 16 ,'name' => "BOUMBA ET NGOKO", 'state_id' => 3),
            array('id' => 17 ,'name' => "HAUT NYONG", 'state_id' => 3),
            array('id' => 18 ,'name' => "KADEY", 'state_id' => 3),
            array('id' => 19 ,'name' => "LOM ET DJEREM 	", 'state_id' => 3),

            array('id' => 20 ,'name' => "MOUNGO", 'state_id' => 4),
            array('id' => 21 ,'name' => "NKAM", 'state_id' => 4),
            array('id' => 22 ,'name' => "SANAGA MARITIME	", 'state_id' => 4),
            array('id' => 23 ,'name' => "WOURI", 'state_id' => 4),

            array('id' => 24 ,'name' => "BENOUE", 'state_id' => 5),
            array('id' => 25 ,'name' => "FARO", 'state_id' => 5),
            array('id' => 26 ,'name' => "MAYO LOUTI	", 'state_id' => 5),
            array('id' => 27 ,'name' => "MAYO REY	", 'state_id' => 5),

            array('id' => 28 ,'name' => "DIAMARE", 'state_id' => 6),
            array('id' => 29 ,'name' => "LOGONE ET CHARI", 'state_id' => 6),
            array('id' => 30 ,'name' => "MAYO DANAY", 'state_id' => 6),
            array('id' => 31 ,'name' => "MAYO KANI", 'state_id' => 6),
            array('id' => 32 ,'name' => "MAYO SAVA", 'state_id' => 6),
            array('id' => 33 ,'name' => "MAYO TSANAGA", 'state_id' => 6),

            array('id' => 34 ,'name' => "BUI", 'state_id' => 7),
            array('id' => 35 ,'name' => "BOYO", 'state_id' => 7),
            array('id' => 36 ,'name' => "DONGA-MANTUNG", 'state_id' => 7),
            array('id' => 37 ,'name' => "MENCHUM", 'state_id' => 7),
            array('id' => 38 ,'name' => "MEZAM", 'state_id' => 7),
            array('id' => 39 ,'name' => "MOMO", 'state_id' => 7),
            array('id' => 40 ,'name' => "NGO-KENTUNJIA", 'state_id' => 7),

            array('id' => 41 , 'name' => "BAMBOUTOS", 'state_id' => 8),
            array('id' => 42 , 'name' => "HAUT NKAM", 'state_id' => 8),
            array('id' => 43 , 'name' => "HAUTS PLATEAUX", 'state_id' => 8),
            array('id' => 44 , 'name' => "KOUNG KHI", 'state_id' => 8),
            array('id' => 45 , 'name' => "MENOUA", 'state_id' => 8),
            array('id' => 46 , 'name' => "MIFI", 'state_id' => 8),
            array('id' => 47 , 'name' => "NDE", 'state_id' => 8),
            array('id' => 48 , 'name' => "NOUN", 'state_id' => 8),

            array('id' => 49 ,'name' => "DJA ET LOBO", 'state_id' => 9),
            array('id' => 50 ,'name' => "VALLEE DU NTEM", 'state_id' => 9),
            array('id' => 51 ,'name' => "MVILA", 'state_id' => 9),
            array('id' => 52 ,'name' => "OCEAN", 'state_id' => 9),

            array('id' => 53 ,'name' => "FAKO", 'state_id' => 10),
            array('id' => 54 ,'name' => "KUPE MANENGUBA", 'state_id' => 10),
            array('id' => 55 ,'name' => "LEBIALEM", 'state_id' => 10),
            array('id' => 56 ,'name' => "MANYU", 'state_id' => 10),
            array('id' => 57 ,'name' => "MEME", 'state_id' => 10),
            array('id' => 58 ,'name' => "NDIAN ", 'state_id' => 10),
        );

        DB::table('departements')->insert($departemnts);


    }
}
