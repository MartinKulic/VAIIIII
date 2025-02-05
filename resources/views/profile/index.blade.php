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
                            <a class="nav-link active" aria-current="page" href="#">Nahrane</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Oblubene</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="hr">

        <main class="col-12 order-lg-2 order-1">

            @foreach($submissions as $submission)
            <div class="container mb-3">
                <div class="row ">
                    <div class="col-12">
                        <div class="d-flex flex-column flex-md-row profileSubInfo">
                            <!-- Obrázok -->
                            <div class="col-md-4 imgColProfile">
                                <img src="{{asset('storage/'. $submission->getImage()->path)}}" class="img-fluid object-fit-cover" alt="Obrázok">
                            </div>
                            <!-- Obsah -->
                            <div class="col-md-8 p-3 d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <h2 class="mb-4">{{$submission->getImage()->name}}</h2>
                                    <span class="rating">Hodnotenie</span>
                                </div>
                                <p class="imgDescInProfile">
                                    {{$submission->getImage()->desc}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </main>

        <div class="row d-flex justify-content-center align-items-center align-self-center text-center">
            <div class="col d-flex d-flex justify-content-center align-items-center align-self-center text-center">
{{--                {{$images->links()}}--}}
            </div>
        </div>

    @endauth
</x-topBar>

