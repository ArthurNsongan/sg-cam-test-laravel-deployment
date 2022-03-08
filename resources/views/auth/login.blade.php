@extends('layouts.app')
@section('title')
    Connexion - TEST
@endsection

@section('content')
    <section class="relative">
        <div class="container-fluid bg-light">
            <div class="min-vh-100 align-items-center justify-content-center row">
                <div class="col-xl-4 col-lg-6">
                    <h1 class="text-center fw-bold mt-2"><span class="text-danger">TEST</span></h1>
                    <h4 class="fw-500 text-center" >Connexion</h4>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <hr class="my-4" />
                        </div>
                    </div>
                    <form class="px-3 mb-2 py-2" method="POST" action="{{ route('auth_login') }}">
                        @csrf
                        @if ($message = Session::get('authError'))
                            <div class="alert alert-danger alert-block">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="25" height="25" fill="none" stroke="#dc3545"><circle cx="6" cy="6" r="4.5"/><path stroke-linejoin="round" d="M5.8 3.6h.4L6 6.5z"/><circle cx="6" cy="8.2" r=".6" fill="#dc3545" stroke="none"/></svg>
                                <span class="fw-600 w-100">{{ $message }}</span>
                                <button type="button" class="btn fs-6 btn-close float-end" data-bs-dismiss="alert" aria-label="close"></button>    
                            </div>
                        @endif
                        <div class="pb-4">
                            <label for="EmailInput" class="form-label fw-500">E-mail</label>
                            <input type="email" autofocus class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" id="EmailInput" autocomplete="" placeholder="ex: votrenom@email.com" required>
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="pb-4">
                            <label for="passwordInput" class="form-label fw-500">Mot de passe</label>
                            <input type="password" name="password" class="form-control @if ($errors->has('password')) is-invalid @endif" id="passwordInput" autocomplete="" placeholder="Entrez votre mot de passe">
                            @if ($errors->has('password'))
                            <div class="invalid-feedback">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="pt-2 pb-4 form-check">
                            <input type="checkbox" name="remember_me" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Se rappeler de moi</label>
                        </div>
                        <button type="submit" class="btn w-100 p-2 rounded-0 fw-500 btn-dark">Se connecter</button>
                    </form>
                    <a href="{{ route('register_page') }}" class="fw-500">Inscrivez-vous</a>
                </div>
            </div>
        </div>
    </section>
@endsection
