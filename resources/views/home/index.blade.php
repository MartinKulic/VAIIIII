<x-topBar>
    <div class = container-fluid>
        <div class="row my-0">


            <!-- Side pannel -->
            @include('components/sidePanel')


                <!-- Galeria obrazkov -->
            <main class="col-xl-10 col-lg-9 col-12 order-lg-2 order-1">

{{--                <!-- Paging -->--}}
{{--                <div class="row d-flex justify-content-center align-items-center align-self-center text-center">--}}

{{--                    <div class="col-6 d-flex d-flex justify-content-end align-items-center align-self-center text-center">--}}
{{--                        {{$images->links()}}--}}
{{--                    </div>--}}
{{--                    <div class="col-6"></div>--}}
{{--                </div>--}}

                <hr class="hr">
                <div class="mainGallery m-lg-3 m-sm-0">

                    @foreach($images as $image)

                    <div class="container">
                        <div class="d-fled flex-column">
                            <a href="{{route('image.detail', ['imgID'=>$image->id])}}"><img src="{{asset('storage/' . $image->path)}}"></a>
                            <div class="scoreRow">
                                <span class="green"> <i class="bi bi-caret-up"></i></span >
                                <span class="score_number">{{ \App\Models\Rating::getRatingValueFor($image->id) }} </span>
                                <span class="red"><i class="bi bi-caret-down"></i></span >
                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>

            </main>



        </div>
        <!-- Paging -->
        <div class="row d-flex justify-content-center align-items-center align-self-center text-center">
            <div class="col d-flex d-flex justify-content-center align-items-center align-self-center text-center">
                {{$images->links()}}
            </div>
        </div>
    </div>


    <script src="{{asset('js/numberColour.js')}}"></script>
    <script>
        //vyfarbenie cisel
        let imagesScoreVals = document.getElementsByClassName("score_number")
        for (let score of imagesScoreVals){
            colour(score)
        }
    </script>
    @if (session("success"))
        <script>
            showTimedAllert("{{session('success')}}", 3000, "success")
        </script>
    @endif
</x-topBar>
