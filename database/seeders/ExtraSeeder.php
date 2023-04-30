<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extras = [
            'GPS',
            'triangle de panne',
            'gilet',
            'caméra de recul',
            'extincteur',
            'régulateur de vitesse',
            'siège bébé'
        ];
        DB::table('extras')->insert(array_map(function ($extra)
        {
            return ["nom" => $extra];
        }, $extras));
    }
}
