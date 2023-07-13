<style>

    .signpages .details:before, .btn-danger {
        background-color: #990000;
    }

</style>

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
                                <img src="{{url('/images/miniarmazem.svg')}}" alt="user" class="ht-100 mb-0" />
                                <h5 class="mt-4 text-white">Mini Armazém</h5>
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
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <h5 class="text-start mb-2">Login de acesso | Mini Armazém</h5>
                                            <p class="mb-4 text-muted tx-13 ms-0 text-start">
                                                Acesse o sistema Mini Armazém da Fundação Hemominas.
                                            </p>

                                            <div class="text-start form-group">
                                                <label for="masp" class="form-label">Código Masp</label>
                                                <input type="text" name="masp" id="masp" class="form-control @error('masp') is_invalid @enderror" value="{{old('masp')}}" required autofocus>

                                                @if ($errors->any())
                                                    @foreach ($errors->all() as $error)
                                                        <span class="invalid-feedback" role="alert" style="color: red; margin-bottom: 5px; display: inline">
                                                            <strong>{{$error}}</strong>
                                                        </span>
                                                    @endforeach
                                                @endif
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

                                            <button type="submit" class="btn ripple btn-danger btn-block mt-2 bt">
                                                Login
                                            </button>
                                        </form>


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
