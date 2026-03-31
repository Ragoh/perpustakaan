<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Novel, cerpen, dan karya fiksi lainnya', 'icon' => '📚'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku berdasarkan fakta dan pengetahuan', 'icon' => '📖'],
            ['name' => 'Sains', 'description' => 'Ilmu pengetahuan alam dan teknologi', 'icon' => '🔬'],
            ['name' => 'Sejarah', 'description' => 'Peristiwa dan catatan sejarah', 'icon' => '🏛️'],
            ['name' => 'Bisnis', 'description' => 'Manajemen, keuangan, dan kewirausahaan', 'icon' => '💼'],
            ['name' => 'Self-Help', 'description' => 'Pengembangan diri dan motivasi', 'icon' => '💡'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}
