<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Kas', 'created_at' => '2021-1-3'],
            ['name' => 'Bonus', 'created_at' => '2021-1-5'],
            ['name' => 'Keperluan', 'created_at' => '2021-1-7'],
            ['name' => 'Biaya Tambahan', 'created_at' => '2021-1-10']
        ];

        DB::table('categories')->insert($categories);
    }
}
