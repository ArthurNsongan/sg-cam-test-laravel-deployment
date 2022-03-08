<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $clients = [
            [
                "nom" => "Client1",
                "prenom" => "client1",
                "cni" => "001",
                'email' => Str::random(10).'@gmail.com',
            ],
            [
                "nom" => "Client2",
                "prenom" => "client2",
                "cni" => "002",
                'email' => Str::random(10).'@gmail.com',
            ],
            [
                "nom" => "Client3",
                "prenom" => "client3",
                "cni" => "003",
                'email' => Str::random(10).'@gmail.com',
            ],
            [
                "nom" => "Client4",
                "prenom" => "client4",
                "cni" => "004",
                'email' => Str::random(10).'@gmail.com',
            ],
        ];

        Client::insert($clients);


        //Enregistrement Client 1
        $clt = Client::find(1);
        $clt->banques()->attach(1);

        //Enregistrement Client 2
        $clt = Client::find(2);
        $clt->banques()->attach(1);
        $clt->banques()->attach(2);
        //Enregistrement Client 3
        $clt = Client::find(3);
        $clt->banques()->attach(1);
        $clt->banques()->attach(2);
        $clt->banques()->attach(3);
        //Enregistrement Client 4
        $clt = Client::find(4);
        $clt->banques()->attach(1);
        $clt->banques()->attach(2);
        $clt->banques()->attach(3);
        $clt->banques()->attach(4);
    }
}
