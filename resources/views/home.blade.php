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
        <div class="container">
            <div class="d-flex">
                <p class="fs-5 py-2">Bienvenue sur <b class="text-danger fw-600">TEST</b>, notre application de gestion bancaire</p>
            </div>
            <div class="row justify-content-start py-3">
                <form class="col-xl-5 col-lg-6" id="updateSoldeForm">
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
            </div>
        </div>
        <div class="modal fade" id="dataTable" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalToggleLabel2">DataTable</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button>
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