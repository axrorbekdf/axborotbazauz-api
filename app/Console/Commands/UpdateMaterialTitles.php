<?php

namespace App\Console\Commands;

use App\Models\Material;
use Illuminate\Console\Command;

class UpdateMaterialTitles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string php artisan materials:update-titles
     */
    protected $signature = 'materials:update-titles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update material titles based on their slug field';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Yangi sarlavhalarni yangilash boshlandi...");

        $count = 0;
        Material::chunk(50, function ($materials) use (&$count) {
            $count++;
            $this->line("=== {$count}-bo‘lim (chunk) ===");

            foreach ($materials as $material) {
                $original = $material->title;
                $newTitle = $material->slugToRealText();

                if ($original !== $newTitle) {
                    $material->title = $newTitle;
                    $material->save();
                    $this->info("✔️ ID {$material->id}: \"$original\" → \"$newTitle\"");
                } else {
                    $this->line("➖ ID {$material->id}: O‘zgartirish kerak emas");
                }
            }

            $this->line("✅ {$count}-chunk yakunlandi.\n");
        });

        $this->info("✅ Barcha materiallar tekshirildi va keraklilari yangilandi.");
    }
}
