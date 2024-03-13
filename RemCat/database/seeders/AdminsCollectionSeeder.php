<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminsCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'email' =>'admin@gmail.com',
            'password' => '$2y$12$bQ27WXfnSaonteJcnqUkBepL4Gp6qxAKdkR6xc6m2Ar/iWRsts5hK',
        ]);
    }
}
