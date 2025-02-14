<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "slug" => "adabiyot",
                "name" => "Adabiyot",
            ],
            [
                "slug" => "algebra",
                "name" => "Algebra",
            ],
            [
                "slug" => "anatomiya",
                "name" => "Anatomiya",
            ],
            [
                "slug" => "arxitektura",
                "name" => "Arxitektura",
            ],
            [
                "slug" => "astronomiya",
                "name" => "Astronomiya",
            ],
            [
                "slug" => "biologiya",
                "name" => "Biologiya",
            ],
            [
                "slug" => "biotexnologiya",
                "name" => "Biotexnologiya",
            ],
            [
                "slug" => "botanika",
                "name" => "Botanika",
            ],
            [
                "slug" => "chizmachilik",
                "name" => "Chizmachilik",
            ],
            [
                "slug" => "chqbt",
                "name" => "CHQBT",
            ],
            [
                "slug" => "davlat-tilida-ish-yuritish",
                "name" => "Davlat tilida ish yuritish",
            ],
            [
                "slug" => "dinshunoslik-asoslari",
                "name" => "Dinshunoslik asoslari",
            ],
            [
                "slug" => "ekologiya",
                "name" => "Ekologiya",
            ],
            [
                "slug" => "energetika",
                "name" => "Energetika",
            ],
            [
                "slug" => "falsafa",
                "name" => "Falsafa",
            ],
            [
                "slug" => "fizika",
                "name" => "Fizika",
            ],
            [
                "slug" => "fransuz-tili",
                "name" => "Fransuz tili",
            ],
            [
                "slug" => "geodeziya",
                "name" => "Geodeziya",
            ],
            [
                "slug" => "geografiya",
                "name" => "Geografiya",
            ],
            [
                "slug" => "geologiya",
                "name" => "Geologiya",
            ],
            [
                "slug" => "geometriya",
                "name" => "Geometriya",
            ],
            [
                "slug" => "huquqshunoslik",
                "name" => "Huquqshunoslik",
            ],
            [
                "slug" => "informatika-va-at",
                "name" => "Informatika va AT",
            ],
            [
                "slug" => "ingliz-tili",
                "name" => "Ingliz tili",
            ],
            [
                "slug" => "iqtisodiyot",
                "name" => "Iqtisodiyot",
            ],
            [
                "slug" => "issiqlik-texnikasi",
                "name" => "Issiqlik texnikasi",
            ],
            [
                "slug" => "jismoniy-tarbiya",
                "name" => "Jismoniy tarbiya",
            ],
            [
                "slug" => "kimyo",
                "name" => "Kimyo",
            ],
            [
                "slug" => "konchilik-ishi",
                "name" => "Konchilik ishi",
            ],
            [
                "slug" => "madaniyatshunoslik",
                "name" => "Madaniyatshunoslik",
            ],
            [
                "slug" => "maktabgacha-va-boshlang-ich-ta-lim",
                "name" => "Maktabgacha va boshlang'ich ta'lim",
            ],
            [
                "slug" => "manaviyat-asoslari",
                "name" => "Manaviyat asoslari",
            ],
            [
                "slug" => "mashinasozlik",
                "name" => "Mashinasozlik",
            ],
            [
                "slug" => "materialshunoslik",
                "name" => "Materialshunoslik",
            ],
            [
                "slug" => "mehnat",
                "name" => "Mehnat",
            ],
            [
                "slug" => "melioratsiya",
                "name" => "Melioratsiya",
            ],
            [
                "slug" => "metrologiya",
                "name" => "Metrologiya",
            ],
            [
                "slug" => "mexanika",
                "name" => "Mexanika",
            ],
            [
                "slug" => "milliy-istiqlol-g-oyasi",
                "name" => "Milliy istiqlol g'oyasi",
            ],
            [
                "slug" => "musiqa",
                "name" => "Musiqa",
            ],
            [
                "slug" => "nemis-tili",
                "name" => "Nemis tili",
            ],
            [
                "slug" => "o-qish",
                "name" => "O'qish",
            ],
            [
                "slug" => "odam-va-uning-salomatligi",
                "name" => "Odam va uning salomatligi",
            ],
            [
                "slug" => "odobnoma",
                "name" => "Odobnoma",
            ],
            [
                "slug" => "oziq-ovqat-texnologiyasi",
                "name" => "Oziq-ovqat texnologiyasi",
            ],
            [
                "slug" => "pedagogik-psixologiya",
                "name" => "Pedagogika",
            ],
            [
                "slug" => "prezident-asarlari",
                "name" => "Prezident asarlari",
            ],
            [
                "slug" => "psixologiya",
                "name" => "Psixologiya",
            ],
            [
                "slug" => "qishloq-va-o-rmon-xo-jaligi",
                "name" => "Qishloq va o'rmon xo'jaligi",
            ],
            [
                "slug" => "radiotexnika",
                "name" => "Radiotexnika",
            ],
            [
                "slug" => "rus-tili-va-adabiyoti",
                "name" => "Rus tili va adabiyoti",
            ],
            [
                "slug" => "san-at",
                "name" => "San'at",
            ],
            [
                "slug" => "siyosatshunoslik",
                "name" => "Siyosatshunoslik",
            ],
            [
                "slug" => "sotsiologiya",
                "name" => "Sotsiologiya",
            ],
            [
                "slug" => "suv-xo-jaligi",
                "name" => "Suv xo'jaligi",
            ],
            [
                "slug" => "tabiatshunoslik",
                "name" => "Tabiatshunoslik",
            ],
            [
                "slug" => "tarix",
                "name" => "Tarix",
            ],
            [
                "slug" => "tasviriy-san-at",
                "name" => "Tasviriy san'at",
            ],
            [
                "slug" => "texnika-va-texnologiya",
                "name" => "Texnika va texnologiya",
            ],
            [
                "slug" => "tibbiyot",
                "name" => "Tibbiyot",
            ],
            [
                "slug" => "tilshunoslik",
                "name" => "Tilshunoslik",
            ],
            [
                "slug" => "to-qimachilik",
                "name" => "To'qimachilik",
            ],
            [
                "slug" => "transport",
                "name" => "Transport",
            ],
            [
                "slug" => "valeologiya",
                "name" => "Valeologiya",
            ],
            [
                "slug" => "xayot-faoliyati-xavfsizligi",
                "name" => "Xayot faoliyati xavfsizligi",
            ],
            [
                "slug" => "zoologiya",
                "name" => "Zoologiya",
            ]
        ];

        foreach($data as $item){
            Subject::firstOrCreate([
                'slug' => Str::slug($item['slug']),
            ],[
                'name' => $item['name'],
                'slug' => $item['slug'],
                'count' => 0,
                'responsible_worker' => 'avtomat'
            ]);
        }
    }
}
