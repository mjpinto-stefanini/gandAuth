@extends('layouts.app')

@section('content')
<div>
    <div class="page main-signin-wrapper">
        <div class="signpages text-center row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row-sm row">
                        <div class="d-none d-lg-block text-center bg-primary details col-xl-5 col-lg-6">
                            <div class="mt-5 pt-4 p-2 pos-absolute" style="width: 95%">
                                <img src="{{url('/images/logo-white.png')}}" alt="Logo Hemominas" class="header-brand-img mb-4" />

                                <div class="clearfix"></div>
                                <img src="{{url('/images/user-shield.svg')}}" alt="user" class="ht-100 mb-0" />
                                <h5 class="mt-4 text-white">Autenticador</h5>
                                <span class="tx-white-6 tx-13 mb-5 mt-xl-0">
                                    Acesse os sistemas da Fundação Hemominas.
                                </span>
                            </div>
                        </div>

                        <div class="login_form col-xl-7 col-lg-6 col-sm-12 col-12">
                            <div class="container-fluid">
                                <div class="row-sm row">
                                    <div class="mt-2 mb-2 card-body">
                                        <img src="{{url('/images/logo.png')}}" alt="Logo Hemominas" class="d-lg-none header-brand-img.text-start" />
                                        <div class="clearfix"></div>
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <h5 class="text-start mb-2">Login de acesso</h5>
                                            <p class="mb-4 text-muted tx-13 ms-0 text-start">
                                                Acesse os sistemas de gestão da Fundação Hemominas.
                                            </p>

                                            <div class="text-start form-group">
                                                <label for="name" class="form-label">Nome</label>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="text-start form-group">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="text-start form-group">
                                                <label for="cpf" class="form-label">CPF</label>
                                                <input id="cpf" type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}" required autocomplete="cpf" autofocus maxlength="11">
                                                @error('cpf')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="text-start form-group">
                                                <label for="password" class="form-label">Senha</label>
                                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="text-start form-group">
                                                <label for="password-confirm" class="form-label">Confirma a senha</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>

                                            <button type="submit" class="btn ripple btn-main-primary btn-main-primary btn-block mt-2 bt btn-primary">
                                                Login
                                            </button>
                                        </form>

{{--                                        <div class="text-start mt-5 ms-0">--}}
{{--                                            <div class="mb-1">--}}
{{--                                                <a href="#">Esqueceu a senha?</a>--}}
{{--                                            </div>--}}

{{--                                            <div>--}}
{{--                                                Não tem conta? <a href="{{ route('register') }}"> solicite seu acesso aqui!   </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

