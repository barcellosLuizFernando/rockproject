<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    -->
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!--
        <link rel="stylesheet" href="/bootstrap/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/fontawesome/vendor/components/font-awesome/css/all.min.css">
    -->
    <link rel="stylesheet" href="/css/styles.css">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    @yield('headscript')
</head>

<body class="">

    <main>
        <nav class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark min-vh-100" style="width: 200px">


            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <img src="/img/RockIngleses_white.svg" alt="logorock">
            </a>

            <br>
            <div class="" id="navbarSupportedContent">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item"><a href="/" class="nav-link text-white @if (session('page') == '/') active @endif"
                            aria-current="page">Home</a></li>
                    <hr>
                    @can('isAdmin')
                        <li class="nav-item"><a href="/manageperiod"
                                class="nav-link text-white @if (session('page') == 'manageperiod') active @endif">Ajustar Ponto</a></li>
                    @endcan
                    <li class="nav-item"><a href="/periodsheet"
                            class="nav-link text-white @if (session('page') == 'periodsheet') active @endif">Registrar
                            Ponto</a></li>
                    <li class="nav-item"><a href="/periodsheet/report"
                            class="nav-link text-white @if (session('page') == 'periodreport') active @endif">Relatório do ponto</a></li>

                    <hr>
                    <li class="nav-item"><a href="/schedule"
                            class="nav-link text-white @if (session('page') == 'schedule') active @endif">Agenda</a>
                    </li>

                    @can('isAdmin')
                        <li class="nav-item"><a href="/registers"
                                class="nav-link text-white @if (session('page') == 'registers') active @endif">Cadastros</a>
                        </li>
                        <li class="nav-item"><a href="/finance"
                                class="nav-link text-white @if (session('page') == 'finance') active @endif">Financeiro</a>
                        </li>
                        <li class="nav-item"><a href="/configs"
                                class="nav-link text-white @if (session('page') == 'configs') active @endif">Configurações</a>
                        </li>

                    @endcan


                </ul>
                <hr>
                <div class="dropdown">
                    <a href="/#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="true" id="dropDownUser">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="" width="32" height="32"
                            class="rounded-circle me-2">
                        <strong>{{ ucfirst(strtolower(strtok(auth()->user()->name, ' '))) }}</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropDownUser"
                        data-popper-placement="top-start"
                        style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(0px, -34px);">
                        <li><a href="/user/profile" class="dropdown-item"><i class="fas fa-users-cog"></i> Perfil</a>
                        </li>
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="/logout" class="dropdown-item" onclick="event.preventDefault();
                            this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i> Sair</a>
                            </form>
                        </li>

                    </ul>
                </div>
            </div>

        </nav>

        @yield('content')

    </main>



    <script src="/js/jQuery.js"></script>
    <script src="/js/inputmask.js"></script>
    <script src="/js/inputmask.binding.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/echarts.min.js"></script>
    <script src="/js/chartisan_echarts.js"></script>

    @yield('bodyscript')
</body>

</html>
