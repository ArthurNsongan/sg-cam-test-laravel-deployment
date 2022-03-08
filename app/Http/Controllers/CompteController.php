<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Banque;
use App\Models\Compte;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class CompteController extends Controller
{
    //Méthode qui affiche la page de définition du solde
    public function home() {

        Transaction::create([
            'libelle' => 'Consultation de Page',
            'url' =>  url(Route::getCurrentRoute()->uri),
            'user_id' => Auth::user()->id,
        ]);

        $banques = Banque::all();
        $comptes = Compte::all();
        return view('home', [
            'banques' => $banques,
            'comptes' => $comptes
        ]  );    
    }

    //Méthode qui récupère la liste des clients d'une banque et la retourne au format JSON
    public function getBanqueClients($id) {
        $clients = Banque::find($id)->clients;
        return response()->json($clients);
    }
    //Méthode quI récupère la liste des comptes d'un client dans une banque et la retourne au format JSON
    public function getBanqueClientComptes($banque_id, $client_id) {
        $comptes = Compte::where([
            'banque_id' => $banque_id,
            'client_id' => $client_id
        ])->get();
        return response()->json($comptes);
    }

    //Méthode qui prend le solde et l'id du compte et met à jour le solde du compte
    public function updateCompte(Request $request) {


        $request->validate([
            'id' => 'required',
            'solde' => 'required|numeric|min:0',
        ]);

        $compte = Compte::findOrFail($request->id);
        $compte->solde = $request->solde;
        $compte->save();

        Transaction::create([
            'libelle' => 'Creation De Solde',
            'url' =>  url(Route::getCurrentRoute()->uri),
            'user_id' => $request['user_id'],
        ]);

        return true;
    }

    //Méthode qui récupère la liste des comptes et la retourne au formqt JSON
    public function getComptes() {
        $comptes = Compte::with('client', 'banque')->get();
        return response()->json($comptes);
    }
}
