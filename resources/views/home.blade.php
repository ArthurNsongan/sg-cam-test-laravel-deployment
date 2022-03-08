@extends('layouts.app')
@section('title')
    TEST- Gestion Bancaire
@endsection

@section('content')
<section class="relative">
    <div class="min-vh-100 bg-light">
        <div class="d-flex flex-wrap justify-content-between align-items-center bg-white shadow-sm py-2 px-5">
            <b class="text-danger fs-4 fw-bold">TEST</b>
            <div class="d-flex align-items-center flex-wrap">
                <span class="d-block fw-500 pe-2">Bonjour, {{ Auth::user()->name }}</span>
                <a href="{{ route('auth_logout') }}" class="btn btn-light shadow-sm fw-600">Se déconnecter</a>
            </div>
        </div>
        <div class="container-fluid align-items-center d-flex flex-column">
            <div class="d-flex">
                <p class="fs-5 py-2">Bienvenue sur <b class="text-danger fw-600">TEST</b>, notre application de gestion bancaire</p>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center py-3">
                <form class="col-xl-5 col-lg-6" id="updateSoldeForm">
                    <input type="hidden" name="_user" value="{{Auth::user()->id}}">
                    <h4 class="fw-600">Gestion des Comptes</h4>
                    <p class="fw-500">Définir le solde d'un compte</p>
                    <div class="pb-4">
                        <label for="BanqueSelect">Banques</label>
                        <select id="BanqueSelect" name="b_i" class="form-select">
                            <option value="">-- Choisir une banque --</option>
                            @foreach ($banques as $b)
                                <option value="{{ $b->id }}" ><span class="fs-5 fw-600">{{ $b->nom }}</span></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pb-4">
                        <label for="ClientSelect" class="form-label">Clients</label>
                        <div id="clientLoader" class="visually-hidden py-2 d-flex px-2 bg-white shadow-sm rounded-5x mb-3">
                            <div class="spinner-border" role="status" style="width: 25px; height: 25px">
                            </div>
                            <span class="fs-6 d-block ps-3 fw-600">Chargement...</span>
                        </div>
                        <select id="ClientSelect" name="c_i" class="form-select" disabled="true">
                            <option></option>
                        </select>
                    </div>
                    <div class="pb-4">
                        <label for="CompteSelect" class="form-label">Comptes</label>
                        <div id="compteLoader" class="visually-hidden py-2 d-flex px-2 bg-white shadow-sm rounded-5x mb-3">
                            <div class="spinner-border" role="status" style="width: 25px; height: 25px">
                            </div>
                            <span class="fs-6 d-block ps-3 fw-600">Chargement...</span>
                        </div>
                        <select id="CompteSelect" name="c_i" class="form-select" disabled="true">
                            <option></option>
                        </select>
                    </div>
                    <div class="pb-4">
                        <label for="Solde">Solde</label>
                        <input type="number" class="form-control" id="Solde" name="solde" min="0" placeholder="Solde" />
                    </div>
                    <div id="AlertSection">    
                    </div>
                    <div class="pb-3">
                        <button type="submit" id="saveButton" class="btn btn-dark fw-600 w-100">
                            <div class="spinner-border visually-hidden" id="submitSpinner" role="status" style="width: 25px; height: 25px">
                            </div>
                            Enregistrer</button>
                    </div>
                </form>
                <div class="col-xl-5 col-lg-6">
                    <table class="table">
                        <thead>
                            <th>Id</th>
                            <th>Libellé Compte</th>
                            <th>Solde</th>
                            <th>Client</th>
                            <th>Banque</th>
                        </thead>
                        <tbody id="compteTableBody">
                            @foreach ($comptes as $c)
                                <tr>
                                    <td><span class="d-block text-center" >{{ $c->id }}</span></td>
                                    <td>{{ $c->libelle }}</td>
                                    <td>{{ $c->solde }}</td>
                                    <td>{{ $c->client->nom }}</td>
                                    <td>{{ $c->banque->nom }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <p class="fs-5 py-2">Listing des transactions sur TEST</p>
            </div>
            <div class="row">
                <div class="">
                    <button class="btn btn-outline-dark fw-600 border-2" id="showTransBtn">Get Transactions</button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="dataTable" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalToggleLabel2">Transactions</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow: auto; height: 500px">
                    <table class="table">
                        <thead>
                            <th>Libellé</th>
                            <th>URL</th>
                            <th>Date/Heure</th>
                        </thead>
                        <tbody id="transTableBody">
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="/js/home.js" />
<script>
    // $("#BanqueSelect").on('change', function() {
    //     console.log($(this).val());
    // });
</script>
@endpush