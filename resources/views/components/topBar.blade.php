<!DOCTYPE html>
<html lang="sk">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="UTF-8">
    <meta lang="sk">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <script src="{{asset("js/allert.js")}}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/mainStyle.css')}}">

</head>

<body  class="bg-body" data-bs-theme="dark">
<header>
    <nav class="navbar navbar-expand-lg bg-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{ asset('assets/Logo.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        @can('createImg', Auth::user())
                    <li class="nav-item">
                        <a class="btn btn btn-outline-info" href="{{route('image.create')}}"><i class="bi bi-arrow-bar-up"></i> Nahrať</a>
                    </li>
                        @endcan

                    @endauth
                    <li class="nav-item">
                        <a class="nav-link <?php if(!request("obdobie")) {echo "active";} ?>" aria-current="page" href="{{route('home')}}">Nedávne</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if(request("obdobie")) {echo "active";} ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Najlepšie za
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item disabled" href="{{route('home.najlepsieZa',['obdobie'=>'den'])}}">Deň</a></li>
                            <li><a class="dropdown-item disabled" href="{{route('home.najlepsieZa',['obdobie'=>'tyzden'])}}">Týždeň</a></li>
                            <li><a class="dropdown-item" href="{{route('home.najlepsieZa',['obdobie'=>'mesiac'])}}">Mesiac</a></li>
                            <li><a class="dropdown-item disabled" href="{{route('home.najlepsieZa',['obdobie'=>'rok'])}}">Rok</a></li>
                        </ul>
                    </li>
                </ul>

                <span class="d-flex">
                    @auth
                        <div class="nav-item dropdown">
                                <div class="nav-link dropdown-toggle active" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <strong>{{ Auth::user()->name }}</strong>

                                    @switch(\Illuminate\Support\Facades\Auth::user()->role )
                                        @case('a')
                                            <span class="badge text-bg-danger">  (admin)</span>
                                            @break
                                        @case('r')
                                            <strong class="badge text-bg-warning">  (restricted)</strong>
                                            @break
                                    @endswitch

                                </div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item " href="{{route('profile', ["userID"=> Auth::id() ,"what"=>"Nahrane"])}}">Profil</a></li>
                                    <li><a class="dropdown-item " href="{{route('profile.edit')}}">Upravit</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form  method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <span class="red">Odhlasit</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>

                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-3">Prihlásiť</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Registrovať</a>
                    @endauth
          </span>
            </div>
        </div>
    </nav>
</header>
<!-- Alerts -->
<div id = alertBar class="position-fixed top-2 start-50 translate-middle-x">

</div>
<div class="container-fluid mt-3">
    <div class="web-content">
        {{$slot}}
    </div>
</div>

<hr class="hr">
<footer class="py-3 py-md-5 mt-5 bg-body-tertiary">
    <div class="container py-3 px-4 text-body-secondary">
        <div class="row d-flex justify-content-around">
            <div class="col-lg-4">
                <a class="d-inline-flex align-items-center mb-2 text-decoration-none text-body-emphasis">
                    <img alt="Logo" src="{{ asset('assets/Logo.png') }}" height="32">
                    <span class="fs-5 ms-2">MeMeMark</span>
                </a>
                <p>MeMeMark je stránka umožňujúca nahrať, organizovať a následe vyhľadať meme (na základe pridelených tagov).</p>
            </div>
            <div class="col-lg-4">
                <p>
                    Lorem ipsum odor amet, consectetuer adipiscing elit. Turpis natoque facilisi vulputate potenti habitant dictum neque amet metus. Orci non et risus pulvinar molestie nibh. Velit facilisis lacinia accumsan aenean posuere class amet sagittis. Ultrices platea libero inceptos; venenatis facilisis vehicula netus. Rutrum nullam ad accumsan nostra ultrices; non praesent. Tempor justo iaculis gravida facilisis porttitor scelerisque euismod per.
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
