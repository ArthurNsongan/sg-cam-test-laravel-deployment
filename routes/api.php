<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->get('/comptes', [CompteController::class, 'getComptes']);
Route::middleware('api')->get('/banque/{id}/clients', [CompteController::class, 'getBanqueClients']);
Route::middleware('api')->get('/banque/{banque_id}/clients/{client_id}/comptes', [CompteController::class, 'getBanqueClientComptes']);
Route::middleware('api')->post('update-compte', [CompteController::class, 'updateCompte']);
Route::middleware('api')->get('/transactions/{id}', [TransactionController::class, 'getTransactions']);

