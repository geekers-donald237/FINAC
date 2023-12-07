<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class DistrictsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('districts')->delete();
        $cities = array (
            array('name' => "Tibati", 'departement_id' => 1),
            array('name' => "Ngaoundal", 'departement_id' => 1),

            array('name' => "Mayo-Baleo", 'departement_id' => 2),
            array('name' => "Tignere", 'departement_id' => 2),
            array('name' => "Galim-tignere", 'departement_id' => 2),
            array('name' => "Kontcha", 'departement_id' => 2),

            array('name' => "Banyo", 'departement_id' => 3),
            array('name' => "Bankim", 'departement_id' => 3),
            array('name' => "Mayo-darle", 'departement_id' => 3),

            array('name' => "Meiganga", 'departement_id' => 4),
            array('name' => "Djohong", 'departement_id' => 4),
            array('name' => "Dir", 'departement_id' => 4),
            array('name' => "Ngaoui", 'departement_id' => 4),

            array('name' => "Ngaoundere 1er", 'departement_id' => 5),
            array('name' => "Ngaoundere 2e", 'departement_id' => 5),
            array('name' => "Ngaoundere 3e", 'departement_id' => 5),
            array('name' => "Belel", 'departement_id' => 5),
            array('name' => "Mbe", 'departement_id' => 5),
            array('name' => "Nganha", 'departement_id' => 5),
            array('name' => "Nyambaka", 'departement_id' => 5),
            array('name' => "Martap", 'departement_id' => 5),



            array('name' => "Mbancjock", 'departement_id' => 6),
            array('name' => "Nanga Eboko", 'departement_id' => 6),
            array('name' => "Minta", 'departement_id' => 6),
            array('name' => "Nkoteng", 'departement_id' => 6),
            array('name' => "Bibey", 'departement_id' => 6),
            array('name' => "Lembe-Yezoum", 'departement_id' => 6),

            array('name' => "Evodoula", 'departement_id' => 7),
            array('name' => "Monatele", 'departement_id' => 7),
            array('name' => "Obala", 'departement_id' => 7),
            array('name' => "Okala", 'departement_id' => 7),
            array('name' => "Saa", 'departement_id' => 7),
            array('name' => "Elig-Mfomo", 'departement_id' => 7),
            array('name' => "Ebebda", 'departement_id' => 7),
            array('name' => "Batshenga", 'departement_id' => 7),
            array('name' => "Lobo", 'departement_id' => 7),

            array('name' => "Bafia", 'departement_id' => 8),
            array('name' => "Bokito", 'departement_id' => 8),
            array('name' => "Deuk", 'departement_id' => 8),
            array('name' => "Makenene", 'departement_id' => 8),
            array('name' => "Ndikinimeki", 'departement_id' => 8),
            array('name' => "Ombessa", 'departement_id' => 8),
            array('name' => "Kiki", 'departement_id' => 8),
            array('name' => "Kon-Yambeta", 'departement_id' => 8),
            array('name' => "Nitoukou", 'departement_id' => 8),


            array('name' => "Ntui", 'departement_id' => 9),
            array('name' => "Ngambe-Tikar", 'departement_id' => 9),
            array('name' => "Ngoro", 'departement_id' => 9),
            array('name' => "Yoko", 'departement_id' => 9),
            array('name' => "Mbangassina", 'departement_id' => 9),

            array('name' => "Mfou", 'departement_id' => 10),
            array('name' => "Esse", 'departement_id' => 10),
            array('name' => "Soa", 'departement_id' => 10),
            array('name' => "Awae", 'departement_id' => 10),
            array('name' => "Afanloum", 'departement_id' => 10),
            array('name' => "Assamba", 'departement_id' => 10),
            array('name' => "Edzendouan", 'departement_id' => 10),
            array('name' => "Nkolafamba", 'departement_id' => 10),

            array('name' => "Ngoumou", 'departement_id' => 11),
            array('name' => "Akono", 'departement_id' => 11),
            array('name' => "Mbankomo", 'departement_id' => 11),
            array('name' => "Bikok", 'departement_id' => 11),

            array('name' => "Yaounde I", 'departement_id' => 12),
            array('name' => "Yaounde II", 'departement_id' => 12),
            array('name' => "Yaounde III", 'departement_id' => 12),
            array('name' => "Yaounde IV", 'departement_id' => 12),
            array('name' => "Yaounde V", 'departement_id' => 12),
            array('name' => "Yaounde VI", 'departement_id' => 12),
            array('name' => "Yaounde VII", 'departement_id' => 12),


            array('name' => "Eseka", 'departement_id' => 13),
            array('name' => "Bot-Makak", 'departement_id' => 13),
            array('name' => "Makak", 'departement_id' => 13),
            array('name' => "Messongo", 'departement_id' => 13),
            array('name' => "Ngog-Mapubi", 'departement_id' => 13),
            array('name' => "Matomb", 'departement_id' => 13),
            array('name' => "Dibang", 'departement_id' => 13),
            array('name' => "Nguibassal", 'departement_id' => 13),
            array('name' => "Bondjock", 'departement_id' => 13),
            array('name' => "Biyouha", 'departement_id' => 13),


            array('name' => "Akonolinga", 'departement_id' => 14),
            array('name' => "Ayos", 'departement_id' => 14),
            array('name' => "Endom", 'departement_id' => 14),
            array('name' => "Mengang", 'departement_id' => 14),
            array('name' => "Yakombo", 'departement_id' => 14),


            array('name' => "Dzend", 'departement_id' => 15),
            array('name' => "Mbalmayo", 'departement_id' => 15),
            array('name' => "Ngomedzap", 'departement_id' => 15),
            array('name' => "Akoeman", 'departement_id' => 15),
            array('name' => "Mengueme", 'departement_id' => 15),
            array('name' => "Nkol-Metet", 'departement_id' => 15),


            array('name' => "MOLOUNDOU", 'departement_id' => 16),
            array('name' => "SALAPOUMBE", 'departement_id' => 16),
            array('name' => "GARI-GOMBO", 'departement_id' => 16),
            array('name' => "YOKADOUMA	", 'departement_id' => 16),

            array('name' => "ABONG-MBANG", 'departement_id' => 17),
            array('name' => "DOUME", 'departement_id' => 17),
            array('name' => "LOMIE", 'departement_id' => 17),
            array('name' => "MESSAMENA", 'departement_id' => 17),
            array('name' => "NGUELEMENDOUKA", 'departement_id' => 17),
            array('name' => "DIMAKO", 'departement_id' => 17),
            array('name' => "NGOYLA", 'departement_id' => 17),
            array('name' => "BEBEND", 'departement_id' => 17),
            array('name' => "MBOUANZ", 'departement_id' => 17),
            array('name' => "DJA", 'departement_id' => 17),
            array('name' => "DOUMAINTANG", 'departement_id' => 17),
            array('name' => "MESSOK", 'departement_id' => 17),
            array('name' => "SAMALOMO", 'departement_id' => 17),
            array('name' => "MBOMA", 'departement_id' => 17),

            array('name' => "BATOURI", 'departement_id' => 18),
            array('name' => "NDELELE", 'departement_id' => 18),
            array('name' => "KETTE", 'departement_id' => 18),
            array('name' => "NDEM-NAM", 'departement_id' => 18),
            array('name' => "BOMBE", 'departement_id' => 18),
            array('name' => "MBOTORO", 'departement_id' => 18),

            array('name' => "BERTOUA 1er", 'departement_id' => 19),
            array('name' => "BERTOUA 2e", 'departement_id' => 19),
            array('name' => "BERTOUA 3e", 'departement_id' => 19),
            array('name' => "BETARE-OYA", 'departement_id' => 19),
            array('name' => "BELABO", 'departement_id' => 19),
            array('name' => "GAROUA-BOULAÏ", 'departement_id' => 19),
            array('name' => "DIANG", 'departement_id' => 19),
            array('name' => "MANDJOU", 'departement_id' => 19),
            array('name' => "NGOURA", 'departement_id' => 19),


            array('name' => "Dibombari", 'departement_id' => 20),
            array('name' => "Loum", 'departement_id' => 20),
            array('name' => "Manjo", 'departement_id' => 20),
            array('name' => "Mbanga", 'departement_id' => 20),
            array('name' => "Melong", 'departement_id' => 20),
            array('name' => "Nkongsamba 1er", 'departement_id' => 20),
            array('name' => "Nkongsamba 2e", 'departement_id' => 20),
            array('name' => "Nkongsamba 32", 'departement_id' => 20),
            array('name' => "NLONAKO", 'departement_id' => 20),
            array('name' => "BARE-BAKEM", 'departement_id' => 20),
            array('name' => "NJOMBE-PENJA", 'departement_id' => 20),
            array('name' => "FIKO", 'departement_id' => 20),
            array('name' => "MOMBO", 'departement_id' => 20),

            array('name' => "NKONDJOCK", 'departement_id' => 21),
            array('name' => "Yabassi", 'departement_id' => 21),
            array('name' => "YINGUI", 'departement_id' => 21),
            array('name' => "NORD-MAKOMBE", 'departement_id' => 21),


            array('name' => "DIZANGUE", 'departement_id' => 22),
            array('name' => "Edea 1er", 'departement_id' => 22),
            array('name' => "Edea 2e", 'departement_id' => 22),
            array('name' => "Ndom", 'departement_id' => 22),
            array('name' => "Ngambe", 'departement_id' => 22),
            array('name' => "Pouma", 'departement_id' => 22),
            array('name' => "MOUANKO", 'departement_id' => 22),
            array('name' => "DIBAMBA", 'departement_id' => 22),
            array('name' => "Ngwei ", 'departement_id' => 22),
            array('name' => "Nyanon", 'departement_id' => 22),
            array('name' => "MASSOCK-SONGLOULOU", 'departement_id' => 22),


            array('name' => "Douala I", 'departement_id' => 23),
            array('name' => "Douala II", 'departement_id' => 23),
            array('name' => "Douala III", 'departement_id' => 23),
            array('name' => "Douala IV", 'departement_id' => 23),
            array('name' => "Douala V", 'departement_id' => 23),
            array('name' => "Douala VI", 'departement_id' => 23),


            array('name' => "Garoua I", 'departement_id' => 24),
            array('name' => "Garoua II", 'departement_id' => 24),
            array('name' => "Garoua III", 'departement_id' => 24),
            array('name' => "BIBEMI", 'departement_id' => 24),
            array('name' => "PITOA", 'departement_id' => 24),
            array('name' => "LAGDO", 'departement_id' => 24),
            array('name' => "DEMBO", 'departement_id' => 24),
            array('name' => "TCHEBOA", 'departement_id' => 24),
            array('name' => "MAYO HOURNA", 'departement_id' => 24),
            array('name' => "TOUROUA", 'departement_id' => 24),
            array('name' => "BASCHEO", 'departement_id' => 24),
            array('name' => "DEMSA	", 'departement_id' => 24),


            array('name' => "POLI", 'departement_id' => 25),
            array('name' => "BEKA", 'departement_id' => 25),


            array('name' => "GUIDER", 'departement_id' => 26),
            array('name' => "MAYO-OULO", 'departement_id' => 26),
            array('name' => "FIGUIL", 'departement_id' => 26),


            array('name' => "TOUBORO", 'departement_id' => 27),
            array('name' => "Rey Bouba", 'departement_id' => 27),
            array('name' => "MADINGRING", 'departement_id' => 27),
            array('name' => "TCHOLLIRE", 'departement_id' => 27),




            array('name' => "BOGO", 'departement_id' => 28),
            array('name' => "Maroua I", 'departement_id' => 28),
            array('name' => "Maroua II", 'departement_id' => 28),
            array('name' => "Maroua III", 'departement_id' => 28),
            array('name' => "MERI", 'departement_id' => 28),
            array('name' => "GAZAWA", 'departement_id' => 28),
            array('name' => "PETTE", 'departement_id' => 28),
            array('name' => "DARGALA", 'departement_id' => 28),
            array('name' => "NDOUKOULA", 'departement_id' => 28),

            array('name' => "KOUSSERI", 'departement_id' => 29),
            array('name' => "MAKARY", 'departement_id' => 29),
            array('name' => "LOGONE-BIRNI", 'departement_id' => 29),
            array('name' => "GOULFEY", 'departement_id' => 29),
            array('name' => "WAZA", 'departement_id' => 29),
            array('name' => "FOTOKOL", 'departement_id' => 29),
            array('name' => "BLANGOUA", 'departement_id' => 29),
            array('name' => "DARAK", 'departement_id' => 29),
            array('name' => "ZINA", 'departement_id' => 29),

            array('name' => "KAR-HAY", 'departement_id' => 30),
            array('name' => "DATCHEKA", 'departement_id' => 30),
            array('name' => "YAGOUA", 'departement_id' => 30),
            array('name' => "GUERE", 'departement_id' => 30),
            array('name' => "MAGA", 'departement_id' => 30),
            array('name' => "KALFOU", 'departement_id' => 30),
            array('name' => "WINA", 'departement_id' => 30),
            array('name' => "VELE", 'departement_id' => 30),
            array('name' => "TCHATIBALI", 'departement_id' => 30),
            array('name' => "GOBO", 'departement_id' => 30),
            array('name' => "KAÏ-KAÏ", 'departement_id' => 30),

            array('name' => "KAELE", 'departement_id' => 31),
            array('name' => "GUIDIGUIS", 'departement_id' => 31),
            array('name' => "MINDIF", 'departement_id' => 31),
            array('name' => "MOUTOURWA", 'departement_id' => 31),
            array('name' => "MOULVOUDAYE", 'departement_id' => 31),
            array('name' => "PORHI", 'departement_id' => 31),
            array('name' => "TAIBONG", 'departement_id' => 31),

            array('name' => "MORA", 'departement_id' => 32),
            array('name' => "TOKOMBERE", 'departement_id' => 32),
            array('name' => "KOLOFATA", 'departement_id' => 32),

            array('name' => "MOKOLO", 'departement_id' => 33),
            array('name' => "BOURRHA", 'departement_id' => 33),
            array('name' => "KOZA", 'departement_id' => 33),
            array('name' => "HINA", 'departement_id' => 33),
            array('name' => "MOGODE", 'departement_id' => 33),
            array('name' => "MAYO-MASKOTA", 'departement_id' => 33),
            array('name' => "SOULEDE-ROUA", 'departement_id' => 33),

            array('name' => "Kumbo", 'departement_id' => 34),
            array('name' => "JAKIRI", 'departement_id' => 34),
            array('name' => "OKU", 'departement_id' => 34),
            array('name' => "MBVEN", 'departement_id' => 34),
            array('name' => "NONI", 'departement_id' => 34),
            array('name' => "NKUM", 'departement_id' => 34),

            array('name' => "Njinikom", 'departement_id' => 35),
            array('name' => "BUM", 'departement_id' => 35),
            array('name' => "FUNDONG", 'departement_id' => 35),
            array('name' => "BELO", 'departement_id' => 35),

            array('name' => "Nkambe", 'departement_id' => 36),
            array('name' => "NWA", 'departement_id' => 36),
            array('name' => "AKO", 'departement_id' => 36),
            array('name' => "MISAJE", 'departement_id' => 36),
            array('name' => "NDU", 'departement_id' => 36),

            array('name' => "WUM", 'departement_id' => 37),
            array('name' => "FURU-AWA", 'departement_id' => 37),
            array('name' => "MENCHUM VALLEY", 'departement_id' => 37),
            array('name' => "FUNGOM", 'departement_id' => 37),

            array('name' => "BAMENDA I", 'departement_id' => 38),
            array('name' => "BAMENDA II", 'departement_id' => 38),
            array('name' => "BAMENDA III", 'departement_id' => 38),
            array('name' => "BALI", 'departement_id' => 38),
            array('name' => "TUBAH", 'departement_id' => 38),
            array('name' => "BAFUT", 'departement_id' => 38),
            array('name' => "SANTA", 'departement_id' => 38),

            array('name' => "BATIBO", 'departement_id' => 39),
            array('name' => "MBENGWI", 'departement_id' => 39),
            array('name' => "NJIKWA", 'departement_id' => 39),
            array('name' => "NGIE", 'departement_id' => 39),
            array('name' => "WIDIKUM-MENKA", 'departement_id' => 39),

            array('name' => "NDOP", 'departement_id' => 40),
            array('name' => "BABESSI", 'departement_id' => 40),
            array('name' => "BALIKUMBAT", 'departement_id' => 40),

            array('name' => "Mbouda", 'departement_id' => 41),
            array('name' => "GALIM", 'departement_id' => 41),
            array('name' => "BATCHAM", 'departement_id' => 41),
            array('name' => "BABADJOU", 'departement_id' => 41),

            array('name' => "BAFANG", 'departement_id' => 42),
            array('name' => "BANA", 'departement_id' => 42),
            array('name' => "BANDJA", 'departement_id' => 42),
            array('name' => "KEKEM", 'departement_id' => 42),
            array('name' => "BAKOU", 'departement_id' => 42),
            array('name' => "BANKA", 'departement_id' => 42),
            array('name' => "BANWA", 'departement_id' => 42),

            array('name' => "BAHAM", 'departement_id' => 43),
            array('name' => "BAMENDJOU", 'departement_id' => 43),
            array('name' => "BANGOU", 'departement_id' => 43),
            array('name' => "BATIE", 'departement_id' => 43),

            array('name' => "POUMOUGNE", 'departement_id' => 44),
            array('name' => "BAYANGAM ", 'departement_id' => 44),
            array('name' => "DJEBEM", 'departement_id' => 44),

            array('name' => "DSCHANG", 'departement_id' => 45),
            array('name' => "PENKA-MICHEl", 'departement_id' => 45),
            array('name' => "FOKOUE", 'departement_id' => 45),
            array('name' => "NKONG-NI", 'departement_id' => 45),
            array('name' => "SANTCHOU", 'departement_id' => 45),
            array('name' => "FONGO TONGO", 'departement_id' => 45),

            array('name' => "BAFOUSSAM I ", 'departement_id' => 46),
            array('name' => "BAFOUSSAM II ", 'departement_id' => 46),
            array('name' => "BAFOUSSAM III ", 'departement_id' => 46),

            array('name' => "BANGANGTE ", 'departement_id' => 47),
            array('name' => "BAZOU", 'departement_id' => 47),
            array('name' => "TONGA", 'departement_id' => 47),
            array('name' => "BASSAMBA", 'departement_id' => 47),

            array('name' => "FOUMBAN", 'departement_id' => 48),
            array('name' => "FOUMBOT", 'departement_id' => 48),
            array('name' => "MALENTOUEN", 'departement_id' => 48),
            array('name' => "MASSANGAM", 'departement_id' => 48),
            array('name' => "MAGBA", 'departement_id' => 48),
            array('name' => "KOUTABA", 'departement_id' => 48),
            array('name' => "BANGOURAIN", 'departement_id' => 48),
            array('name' => "KOUOPTAMO", 'departement_id' => 48),
            array('name' => "NJIMON", 'departement_id' => 48),

            array('name' => "BENGBIS", 'departement_id' => 49),
            array('name' => "DJOUM", 'departement_id' => 49),
            array('name' => "SANGMELIMA", 'departement_id' => 49),
            array('name' => "ZOETELE", 'departement_id' => 49),
            array('name' => "OVENG", 'departement_id' => 49),
            array('name' => "MINTOM", 'departement_id' => 49),
            array('name' => "MEYOMESSALA", 'departement_id' => 49),
            array('name' => "MEYOMESSI", 'departement_id' => 49),

            array('name' => "AMBAM", 'departement_id' => 50),
            array('name' => "MA'AN", 'departement_id' => 50),
            array('name' => "OLAMZE", 'departement_id' => 50),
            array('name' => "KYE OSSI", 'departement_id' => 50),

            array('name' => "Ebolowa I", 'departement_id' => 51),
            array('name' => "Ebolowa II", 'departement_id' => 51),
            array('name' => "BIWONG-BANE", 'departement_id' => 51),
            array('name' => "MVANGAN", 'departement_id' => 51),
            array('name' => "MENGONG", 'departement_id' => 51),
            array('name' => "NGOULEMAKONG", 'departement_id' => 51),
            array('name' => "EFOULAN", 'departement_id' => 51),
            array('name' => "BIWONG BULU", 'departement_id' => 51),

            array('name' => "AKOM II", 'departement_id' => 52),
            array('name' => "CAMPO", 'departement_id' => 52),
            array('name' => "KRIBI I", 'departement_id' => 52),
            array('name' => "KRIBI II", 'departement_id' => 52),
            array('name' => "LOLODORF", 'departement_id' => 52),
            array('name' => "MVENGUE", 'departement_id' => 52),
            array('name' => "BIPINDI", 'departement_id' => 52),
            array('name' => "LOKOUNDJE", 'departement_id' => 52),
            array('name' => "NIETE", 'departement_id' => 52),



            array('name' => "MUYUKA", 'departement_id' => 53),
            array('name' => "TIKO", 'departement_id' => 53),
            array('name' => "LIMBE I", 'departement_id' => 53),
            array('name' => "LIMBE II", 'departement_id' => 53),
            array('name' => "LIMBE III", 'departement_id' => 53),
            array('name' => "Buea", 'departement_id' => 53),
            array('name' => "WEST-COAST", 'departement_id' => 53),

            array('name' => "BANGEM", 'departement_id' => 54),
            array('name' => "NGUTI", 'departement_id' => 54),
            array('name' => "TOMBEL", 'departement_id' => 54),

            array('name' => "FONTEM", 'departement_id' => 55),
            array('name' => "ALOU", 'departement_id' => 55),
            array('name' => "WABANE", 'departement_id' => 55),

            array('name' => "AKWAYA", 'departement_id' => 56),
            array('name' => "MAMFE", 'departement_id' => 56),
            array('name' => "EYUMODJOCK", 'departement_id' => 56),
            array('name' => "UPPER-BAYANG", 'departement_id' => 56),

            array('name' => "KUMBA I", 'departement_id' => 57),
            array('name' => "KUMBA II", 'departement_id' => 57),
            array('name' => "KUMBA III", 'departement_id' => 57),
            array('name' => "KONYE", 'departement_id' => 57),
            array('name' => "BONGE", 'departement_id' => 57),

            array('name' => "BAMUSSO", 'departement_id' => 58),
            array('name' => "EKONDO-TITI", 'departement_id' => 58),
            array('name' => "ISANGUELE", 'departement_id' => 58),
            array('name' => "MUNDEMBA", 'departement_id' => 58),
            array('name' => "KOMBO ABEDIMO", 'departement_id' => 58),
            array('name' => "KOMBO IDINTI", 'departement_id' => 58),
            array('name' => "IDABATO", 'departement_id' => 58),
            array('name' => "DIKOME-BALUE", 'departement_id' => 58),
            array('name' => "TOKO", 'departement_id' => 58),

        );

        foreach ($cities as &$city) {
            $city['id'] = Uuid::uuid4()->toString();
        }
        DB::table('districts')->insert($cities);


    }

}


