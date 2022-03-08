<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;
use App\Models\Banque;

class Compte extends Model
{
    use HasFactory;

    public function banque()
    {
        return $this->belongsTo(Banque::class, 'banque_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
