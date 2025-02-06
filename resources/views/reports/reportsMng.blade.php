<x-topBar>
    <div class="container">
        <div class="row d-flex d-flex justify-content-between">
            <div class="col">
                <span class="h1">Reports</span>
                <span class="h4  position-relative">
                        <span class="position-absolute top-0 start-100 translate-middle-y badge rounded-pill bg-danger">admin</span>
                </span>

            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <ul class="nav nav-pills  ">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{route('profile', ["userID"=>Auth::id(), "what"=>"Nahrane"])}}">Nahrane</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('profile', ["userID"=>Auth::id(), "what"=>"Fav"])}}">Oblubene</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active bg-danger" href="{{route('reports')}}">Reports</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <hr class="hr">

    <main class="col-12 order-lg-2 order-1">

        @foreach($reports as $report)
        @include("reports/partials/report-view")
        @endforeach

    </main>

    <div class="row d-flex justify-content-center align-items-center align-self-center text-center">
        <div class="col d-flex d-flex justify-content-center align-items-center align-self-center text-center">
{{--            {{$images->links()}}--}}
        </div>
    </div>

</x-topBar>

<script src="{{asset('js/numberColour.js')}}"></script>
<script>
    //vyfarbenie cisel
    let imagesScoreVals = document.getElementsByClassName("score_number")
    for (let score of imagesScoreVals){
        colour(score)
    }
</script>


