@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="/home" class="d-flex align-items-center text-dark text-decoration-none">
                    <img class="mb-2" src="{{url('/images/user-shield.svg')}}"  alt="" width="35">
                    <span class="fs-4">Autenticador Central</span>
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="py-2 text-dark text-decoration-none" href="{{ url('logout') }}">Sair</a>
                </nav>
            </div>

            <div class="p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-9 fw-normal">Usuário {{ Auth::user()->name }} autenticado.</h1>
                <p class="fs-5 text-muted">Os seguintes sistemas abaixo utilizam esta autenticação:</p>
            </div>
        </header>

        <main>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

                <div class="col">
                    <div class="card mb-4 rounded-4 shadow-sm border-primary">
                        <div class="card-header py-3 text-white bg-primary border-primary">
                            <h4 class="my-0 fw-normal">SGPR</h4>
                        </div>
                        <div class="card-body">
                            <a role="button" class="w-100 btn btn-lg btn-primary" href="http://sgpr.hemominas.hom">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card mb-4 rounded-4 shadow-sm border-primary">
                        <div class="card-header py-3 text-white bg-primary border-primary">
                            <h4 class="my-0 fw-normal">PAINEL</h4>
                        </div>
                        <div class="card-body">
                            <a role="button" class="w-100 btn btn-lg btn-primary" href="http://painel.hemominas.hom">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card mb-4 rounded-4 shadow-sm border-primary">
                        <div class="card-header py-3 text-white bg-primary border-primary">
                            <h4 class="my-0 fw-normal">MINI ARMAZÉM</h4>
                        </div>
                        <div class="card-body">
                            <a role="button" class="w-100 btn btn-lg btn-primary" href="http://miniarmazem.hemominas.hom">Acessar</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="pt-4 my-md-5 pt-md-5 border-top text-center">
            <div class="row">
                <div class="col-12 col-md">
                    <img class="mb-2" src="{{url('/images/user-shield.svg')}}"  alt="" width="24" height="19">
                     <small class="d-block mb-3 text-muted">&copy; {{ now()->year }} | Hemominas</small>
                </div>
            </div>
        </footer>
    </div>

@endsection
