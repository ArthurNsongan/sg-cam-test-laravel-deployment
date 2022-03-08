<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Banque;


class BanqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banques = [
            [
                "nom" => 'banque1',
                "code" => 'Bank-01'
            ],
            [
                "nom" => 'banque2',
                "code" => 'Bank-02'
            ],
            [
                "nom" => 'banque3',
                "code" => 'Bank-03'
            ],
            [
                "nom" => 'banque4',
                "code" => 'Bank-04'
            ],
        ];

        Banque::insert($banques);

    }
}
