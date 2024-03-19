<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamsCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Todas las passwords son admin
     */
    public function run(): void
    {
        Team::create([
            'email' =>'rembadalona@gmail.com',
            'password' => '$2y$12$bQ27WXfnSaonteJcnqUkBepL4Gp6qxAKdkR6xc6m2Ar/iWRsts5hK',
            'team_name' => 'Club de Rem Badalona',
            'image_team' => 'default.png',
        ]);
        Team::create([
            'email' =>'nataciobadalona@gmail.com',
            'password' => '$2y$12$bQ27WXfnSaonteJcnqUkBepL4Gp6qxAKdkR6xc6m2Ar/iWRsts5hK',
            'team_name' => 'Club Natació Badalona',
            'image_team' => 'default.png',
        ]);
        Team::create([
            'email' =>'betulo@gmail.com',
            'password' => '$2y$12$bQ27WXfnSaonteJcnqUkBepL4Gp6qxAKdkR6xc6m2Ar/iWRsts5hK',
            'team_name' => 'Club Nàutic Bétulo',
            'image_team' => 'default.png',
        ]);
        Team::create([
            'email' =>'aexinoxano@gmail.com',
            'password' => '$2y$12$bQ27WXfnSaonteJcnqUkBepL4Gp6qxAKdkR6xc6m2Ar/iWRsts5hK',
            'team_name' => 'A.E. Xino Xano Deltebre',
            'image_team' => 'default.png',
        ]);
        Team::create([
            'email' =>'nauticflix@gmail.com',
            'password' => '$2y$12$bQ27WXfnSaonteJcnqUkBepL4Gp6qxAKdkR6xc6m2Ar/iWRsts5hK',
            'team_name' => 'Club Nàutic Flix',
            'image_team' => 'default.png',
        ]);
        Team::create([
            'email' =>'vecambrills@gmail.com',
            'password' => '$2y$12$bQ27WXfnSaonteJcnqUkBepL4Gp6qxAKdkR6xc6m2Ar/iWRsts5hK',
            'team_name' => "Vent d'Estrop Vogadors de Cambrills",
            'image_team' => 'default.png',
        ]);
        Team::create([
            'email' =>'remcambrills@gmail.com',
            'password' => '$2y$12$bQ27WXfnSaonteJcnqUkBepL4Gp6qxAKdkR6xc6m2Ar/iWRsts5hK',
            'team_name' => "Club de rem Cambrills",
            'image_team' => 'default.png',
        ]);
        Team::create([
            'email' =>'remmataro@gmail.com',
            'password' => '$2y$12$bQ27WXfnSaonteJcnqUkBepL4Gp6qxAKdkR6xc6m2Ar/iWRsts5hK',
            'team_name' => "Club de rem Mataró",
            'image_team' => 'default.png',
        ]);
    }
}
