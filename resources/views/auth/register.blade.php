@extends('layouts.app')
@section('title')
    Inscription - TEST
@endsection

@section('content')
    <section class="relative">
        <div class="container-fluid bg-light">
            <div class="min-vh-100 align-items-center justify-content-center row">
                <div class="col-xl-4 col-lg-6">
                    <h1 class="text-center fw-bold mt-2"><span class="text-danger">TEST</span></h1>
                    <h4 class="fw-500 text-center" >Inscription</h4>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <hr class="my-4" />
                        </div>
                    </div>
                    <form class="px-3 mb-2 py-2" method="POST" action="{{ route('auth_register') }}">
                        @csrf
                        <div class="pb-4">
                            <label for="NameInput" class="form-label fw-500">Nom</label>
                            <input type="text" autofocus class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" id="NameInput" autocomplete="" placeholder="">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback pb-1">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="pb-4">
                            <label for="EmailInput" class="form-label fw-500">E-mail</label>
                            <input type="email" autofocus class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" id="EmailInput" autocomplete="" placeholder="ex: votrenom@email.com">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback pb-1">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="pb-4">
                            <label for="passwordInput" class="form-label fw-500">Mot de passe</label>
                            <input type="password" name="password" class="form-control @if ($errors->has('password')) is-invalid @endif" id="passwordInput" autocomplete="" placeholder="Entrez votre mot de passe">
                            @if ($errors->has('password'))
                            <div class="invalid-feedback pb-1">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="pb-4">
                            <label for="passwordConfirmInput" class="form-label fw-500">Confirmation mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmInput" autocomplete="" placeholder="">
                        </div>
                        <button type="submit" class="btn w-100 p-2 rounded-0 fw-500 btn-dark">S'inscrire</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
