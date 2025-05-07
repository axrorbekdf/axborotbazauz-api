<?php

namespace App\Models;

use App\Filter\Trait\QueryFilter;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory, Searchable, QueryFilter;

    protected $fillable = [
        "title",
        "slug",
        "category_id",
        "subject_id",
        "downloads",
        "path",
        "size",
        "type",
        "responsible_worker",
    ];

    protected $searchable = [
        "title",
        // "slug",
        // "downloads",
        "category.name",
        "subject.name",
        // "size",
        // "type",
        // "responsible_worker",
        "pages.content"
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function pages(){
        return $this->hasMany(MaterialPage::class);
    }

    public function slugToRealText() {
        $replaceMap = [
            // Maxsus belgilarni to'g'rilash
            'g-oya' => "g‘oya",
            'she-r' => "she’r",
            'o-quvchi' => "o‘quvchi",
            'y-il' => "yil",
            'd-ars' => "dars",
            'b-ir' => "bir",
            'm-avzu' => "mavzu",
            'f-an' => "fan",
            'i-shlanma' => "ishlanma",
            'k-urs' => "kurs",
            'a-dabiyot' => "adabiyot",
            't-arix' => "tarix",
            'i-ngliz' => "ingliz",
            'o-nalik' => "o‘nalik",
            't-ezis' => "tezis",
          
            // Qo'shimcha so'zlar
            'm-aktab' => "maktab",
            'o-‘qituvchi' => "o‘qituvchi",
            't-alaba' => "talaba",
            'f-ilologiya' => "filologiya",
            'm-atematika' => "matematika",
            'b-iologiya' => "biologiya",
            'k-imyo' => "kimyo",
            'f-izika' => "fizika",
            't-ehnologiya' => "texnologiya",
            's-harqiy' => "sharqiy",
            'g-arbiy' => "g‘arbiy",
            'o-‘zbekiston' => "O‘zbekiston",
            't-oshkent' => "Toshkent",
            's-amarkand' => "Samarqand",
            'b-uxoro' => "Buxoro",
            'n-avoi' => "Navoiy",
            'a-ndijon' => "Andijon",
            'f-arg‘ona' => "Farg‘ona",
            'q-ashqadaryo' => "Qashqadaryo",
            's-irdaryo' => "Sirdaryo",
            'j-izzax' => "Jizzax",
            'x-orazm' => "Xorazm",
            'q-oraqalpog‘iston' => "Qoraqalpog‘iston",
            'n-amangan' => "Namangan",
            's-urxondaryo' => "Surxondaryo",
            't-ermiz' => "Termiz",
            'q-arshi' => "Qarshi",
            'n-ukus' => "Nukus",
            'u-rganch' => "Urganch",
            'g-uliston' => "Guliston",
            'a-ngren' => "Angren",
            'b-ekobod' => "Bekobod",
            'c-hirchiq' => "Chirchiq",
            'f-arg‘ona' => "Farg‘ona",
            'm-arg‘ilon' => "Marg‘ilon",
            'q-oqon' => "Qo‘qon",
            'a-ndijon' => "Andijon",
            'n-amangan' => "Namangan",
            's-amarqand' => "Samarqand",
            'b-uxoro' => "Buxoro",
            'n-avoi' => "Navoiy",
            'q-arshi' => "Qarshi",
            't-ermiz' => "Termiz",
            'n-ukus' => "Nukus",
            'u-rganch' => "Urganch",
            'g-uliston' => "Guliston",
            'j-izzax' => "Jizzax",
            's-irdaryo' => "Sirdaryo",
            'q-ashqadaryo' => "Qashqadaryo",
            's-urxondaryo' => "Surxondaryo",
            'x-orazm' => "Xorazm",
            'q-oraqalpog‘iston' => "Qoraqalpog‘iston"
        ];
          

        // Avval maxsus almashtirishlar
        foreach ($replaceMap as $key => $val) {
            // faqat so'z sifatida mos kelsagina almashtiradi
            $slug = preg_replace('/\b' . preg_quote($key, '/') . '\b/i', $val, $this->slug);
        }

        $parts = explode('-', $slug);
        $result = [];

        $i = 0;
        while ($i < count($parts)) {
            $word = $parts[$i];

            // Raqam bo‘lsa
            if (ctype_digit($word)) {
                $result[] = $word;
                $i++;
                continue;
            }

            // Format: "9-sinf-1" bo‘lsa
            if (
                $i + 2 < count($parts) &&
                ctype_digit($parts[$i]) &&
                ctype_alpha($parts[$i + 1]) &&
                ctype_digit($parts[$i + 2])
            ) {
                $result[] = $parts[$i] . '-' . ucfirst(strtolower($parts[$i + 1])) . ' (' . $parts[$i + 2] . ')';
                $i += 3;
                continue;
            }

            // Ism yoki familiya deb taxmin: 0–3 indekslar orasida
            if ($i <= 3) {
                $result[] = ucfirst(strtolower($word));
            } else {
                $result[] = strtolower($word);
            }

            $i++;
        }

        return implode(' ', $result);
    }

    
}
