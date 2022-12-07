<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="ltr app sidebar-mini landing-page" style="background-color: #17191a;">
    <noscript>Você precisa habilitar Javascript para rodar esta aplicação.</noscript>

    <div id="root">
        <div class="horizontalMenucontainer">
            <div class="page">
                <div class="page-main">
                    <div class="landing-top-header overflow-hidden">
                        <div class="top sticky">
                            <div class="app-sidebar bg-transparent">
                                <div class="container">
                                    <div class="row">
                                        <div class="navbar main-sidemenu px-0">
                                            <a href="/" class="main-logo">
                                                <img src="{{url('/images/logo-white.png')}}" alt="Logo Hemominas" class="header-brand-img desktop-logo" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="demo-screen-headline main-demo main-demo-1 spacing-top overflow-hidden reveal">
                            <div class="px-sm-0 container">
                                <div class="row">
                                    <div class="animation-zindex pos-relative col-xl-6 col-lg-6">
                                        <h4 class="fw-semibold mt-7">Sistemas de Gestão</h4>
                                        <h1 class="text-start fw-bold">Fundação Hemominas</h1>
                                        <h6 class="pb-3">
                                            A Fundação Hemominas,  conforme Decreto n° 48.023 de 17 de agosto de 2020, tem por finalidade garantir à população 
                                            a oferta de sangue, hemoderivados, células e tecidos, em consonância com as diretrizes estabelecidas pela 
                                            Política Estadual de Saúde, obedecidos os padrões de excelência e qualidade.
                                        </h6>
                                    </div>

                                    <div class="my-auto col-xl-6 col-lg-6">
                                        <img src="{{url('/images/donation.png')}}" alt="Market" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="main-content mt-0">

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
