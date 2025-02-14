<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                
                "slug" => "dars-ishlanmalar",
                "name" => "Dars ishlanmalar",
            ],
            [
                "slug" => "diplom-ishlar",
                "name" => "Diplom ishlar",
            ],
            [
                "slug" => "darsliklar",
                "name" => "Slaydlar (maktab darsliklari bo'yicha)",
            ],
            [
                "slug" => "slaydlar",
                "name" => "Slaydlar",
            ],
            [
                "slug" => "referatlar",
                "name" => "Referatlar",
            ],
            [
                "slug" => "kurs-ishlari",
                "name" => "Kurs ishlari",
            ]
        ];

        foreach($data as $item){
            Category::firstOrCreate([
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
