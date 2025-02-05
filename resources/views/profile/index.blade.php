<x-topBar>
    @auth
        <div class="container">
            <div class="row d-flex d-flex justify-content-between">
                <div class="col">
                    <h1>{{ Auth::user()->name }}</h1>
                </div>
                <div class="col d-flex justify-content-end align-items-center">
                    <ul class="nav nav-pills  ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Moje</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Oblubene</a>
                        </li>
                    </ul>
            </div>
        </div>

        <main class="col-xl-10 col-lg-9 col-12 order-lg-2 order-1">

        </main>

    @endauth
</x-topBar>

