<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            [
                'date_reservation' => Carbon::parse('2023-03-01'),
                'date_debut' => Carbon::parse('2023-03-05'),
                'heure_debut' => '10:00:00',
                'date_fin' => Carbon::parse('2023-03-10'),
                'heure_fin' => '12:00:00',
                'status' => 'En attente',
                'commentaire' => 'Première réservation',
                'client_id' => 1,
                'vehicule_id' => 1,
                'user_id' => 1,
            ],
            [
                'date_reservation' => Carbon::parse('2023-03-10'),
                'date_debut' => Carbon::parse('2023-03-15'),
                'heure_debut' => '09:00:00',
                'date_fin' => Carbon::parse('2023-03-20'),
                'heure_fin' => '11:00:00',
                'status' => 'En attente',
                'commentaire' => 'Deuxième réservation',
                'client_id' => 2,
                'vehicule_id' => 2,
                'user_id' => 1,
            ],
            [
                'date_reservation' => Carbon::parse('2023-04-01'),
                'date_debut' => Carbon::parse('2023-04-05'),
                'heure_debut' => '14:00:00',
                'date_fin' => Carbon::parse('2023-04-10'),
                'heure_fin' => '16:00:00',
                'status' => 'En attente',
                'commentaire' => 'Troisième réservation',
                'client_id' => 3,
                'vehicule_id' => 3,
                'user_id' => 2,
            ],
            [
                'date_reservation' => Carbon::parse('2023-05-01'),
                'date_debut' => Carbon::parse('2023-05-05'),
                'heure_debut' => '11:00:00',
                'date_fin' => Carbon::parse('2023-05-10'),
                'heure_fin' => '13:00:00',
                'status' => 'En attente',
                'commentaire' => 'Quatrième réservation',
                'client_id' => 4,
                'vehicule_id' => 4,
                'user_id' => 3,
            ],
            [
                'date_reservation' => Carbon::parse('2023-06-01'),
                'date_debut' => Carbon::parse('2023-06-05'),
                'heure_debut' => '13:00:00',
                'date_fin' => Carbon::parse('2023-06-10'),
                'heure_fin' => '15:00:00',
                'status' => 'En attente',
                'commentaire' => 'Sixième réservation',
                'client_id' => 6,
                'vehicule_id' => 6,
                'user_id' => 6,
            ],
        ];

        foreach ($reservations as $reservation) {
            DB::table('reservations')->insert($reservation);
        }
    }
}
