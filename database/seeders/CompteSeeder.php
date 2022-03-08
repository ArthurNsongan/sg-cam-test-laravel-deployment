<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compte;

class CompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Compte::create([
            'libelle' => 'Compte Epargne',
            'solde' => 0,
            'client_id' => 1,
            'banque_id' => 1,
        ]);

        Compte::create([
            'libelle' => 'Compte Courant',
            'solde' => 0,
            'client_id' => 1,
            'banque_id' => 1,
        ]);

        Compte::create([
            'libelle' => 'Compte Epargne',
            'solde' => 0,
            'client_id' => 2,
            'banque_id' => 1,
        ]);

        Compte::create([
            'libelle' => 'Compte Courant',
            'solde' => 0,
            'client_id' => 2,
            'banque_id' => 2,
        ]);

        Compte::create([
            'libelle' => 'Compte Epargne',
            'solde' => 0,
            'client_id' => 3,
            'banque_id' => 1,
        ]);

        Compte::create([
            'libelle' => 'Compte Epargne',
            'solde' => 0,
            'client_id' => 3,
            'banque_id' => 2,
        ]);

        Compte::create([
            'libelle' => 'Compte Courant',
            'solde' => 0,
            'client_id' => 3,
            'banque_id' => 3,
        ]);

        Compte::create([
            'libelle' => 'Compte Courant',
            'solde' => 0,
            'client_id' => 4,
            'banque_id' => 1,
        ]);

        Compte::create([
            'libelle' => 'Compte Epargne',
            'solde' => 0,
            'client_id' => 4,
            'banque_id' => 2,
        ]);

        Compte::create([
            'libelle' => 'Compte Courant',
            'solde' => 0,
            'client_id' => 4,
            'banque_id' => 3,
        ]);

        Compte::create([
            'libelle' => 'Compte Epargne',
            'solde' => 0,
            'client_id' => 4,
            'banque_id' => 4,
        ]);
    }
}
