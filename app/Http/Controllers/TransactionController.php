<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class TransactionController extends Controller
{
    //Méthode qui prend l'id de l'utilisateur connecté et retourner ses transactions d'utilisation de l'application
    public function getTransactions($id) {
        $transactions = DB::table('transactions')->where('user_id', $id)->get();
        return response()->json($transactions);
    }
}
