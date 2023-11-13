<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'create-categories','display_name' => 'Create','description' => 'Membuat Kategori',],
            ['name' => 'edit-categories','display_name' => 'edit','description' => 'Mengedit Kategori',],
            ['name' => 'delete-categories','display_name' => 'delete','description' => 'Menghapus Kategori',],
            ['name' => 'create-cashflow','display_name' => 'Create','description' => 'Membuat Cashflow',],
            ['name' => 'edit-cashflow','display_name' => 'edit','description' => 'Mengedit Cashflow',],
            ['name' => 'delete-cashflow','display_name' => 'delete','description' => 'Mengahpus Cashflow',],
        ];

        foreach ($permissions as $permissionData) {
            Permission::create($permissionData);
        }
    }
}
