<!DOCTYPE html>
<!--suppress HtmlUnknownTarget -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PMS</title>

    <link rel="icon" type="image/png" href="favicon.png" sizes="16x16" />
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/css/bootstrap.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/css/bootstrap-theme.min.css') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@if (Auth::check())
    <div id="navbar" class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button
                    type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#navbar-collapse"
                    aria-expanded="false"
                >
                    <span class="sr-only">Mostrar/esconder navegação</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/comments">
                    <img alt="Logomarca" src="{{ asset("logo.svg") }}" height="42px" width="42px" />
                </a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a
                            href="#"
                            class="dropdown-toggle"
                            data-toggle="dropdown"
                            role="button"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >Perfil<span class="caret"></span
                            ></a>
                        <ul class="dropdown-menu">
                            <li @class(["active" => Route::is('profile')])>
                                <a href="/profile">Perfil</a>
                            </li>
                            <li @class(["active" => Route::is('cards.index')])>
                                <a href="/cards">Cartões</a>
                            </li>
                            <li @class(["active" => Route::is('pix.index')])>
                                <a href="/pix">Pix</a>
                            </li>
                        </ul>
                    </li>

                    <li @class(["active" => Route::is('comments.index')])>
                        <a href="/comments">Comentários/sugestões</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="btn btn-link" type="button" href="/logout">
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif

{{ $slot }}

<script src="{{ asset('vendor/js/jquery-2.1.0.min.js') }}"></script>
<script src="{{ asset('vendor/js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('vendor/js/bootstrap.min.js') }}"></script>

</body>
</html>

