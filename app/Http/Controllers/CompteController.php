<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banque;
use App\Models\Compte;

class CompteController extends Controller
{
    public function home() {
        $banques = Banque::all();
        return view('home', [
            'banques' => $banques
        ]  );    
    }

    public function getBanqueClients($id) {
        $clients = Banque::find($id)->clients;
        return response()->json($clients);
    }

    public function getBanqueClientComptes($banque_id, $client_id) {
        $comptes = Compte::where([
            'banque_id' => $banque_id,
            'client_id' => $client_id
        ])->get();
        return response()->json($comptes);
    }

    public function updateCompte(Request $request) {

        $request->validate([
            'id' => 'required',
            'solde' => 'required|numeric|min:0',
        ]);

        $compte = Compte::findOrFail($request->id);
        $compte->solde = $request->solde;
        $compte->save();

        return true;
    }
}
