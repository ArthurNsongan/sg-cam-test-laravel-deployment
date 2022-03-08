<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Banque;

class Client extends Model
{
    use HasFactory;

    public function banques()
    {
        return $this->belongsToMany(Banque::class, 'clients_banques', 'client_id', 'banque_id');
    }
}
