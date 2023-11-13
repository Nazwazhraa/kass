<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashflowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashflows = [
            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-1-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 200_000, 'created_at' => '2021-1-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 100_000, 'created_at' => '2021-1-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' => 250_000, 'created_at' => '2021-1-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 750_000, 'created_at' => '2021-1-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 140_000, 'created_at' => '2021-1-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 300_000, 'created_at' => '2021-1-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-2-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 200_000, 'created_at' => '2021-2-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 100_000, 'created_at' => '2021-2-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' => 250_000, 'created_at' => '2021-2-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 800_000, 'created_at' => '2021-2-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 140_000, 'created_at' => '2021-2-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 100_000, 'created_at' => '2021-2-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-3-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 200_000, 'created_at' => '2021-3-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 100_000, 'created_at' => '2021-3-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' => 250_000, 'created_at' => '2021-3-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 800_000, 'created_at' => '2021-3-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 140_000, 'created_at' => '2021-3-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 100_000, 'created_at' => '2021-3-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-4-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 200_000, 'created_at' => '2021-4-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 100_000, 'created_at' => '2021-4-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' => 250_000, 'created_at' => '2021-4-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 650_000, 'created_at' => '2021-4-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 140_000, 'created_at' => '2021-4-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 100_000, 'created_at' => '2021-4-21'],

        ];

        DB::table('cashflows')->insert($cashflows);
    }
}
