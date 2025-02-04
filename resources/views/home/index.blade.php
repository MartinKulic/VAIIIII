<x-topBar>
    <div class = container-fluid>
        <div class="row">

{{--            <?php if (!is_null(@$data['messages'])): ?>--}}
{{--                <?php foreach ($data['messages'] as $msg): ?>--}}
{{--            <div class="alert alert-primary" role="alert" role="alert">--}}
{{--                    <?= $msg ?>--}}
{{--            </div>--}}
{{--            <?php endforeach; ?>--}}
{{--            <?php endif; ?>--}}

            <span class="pagesNavigator">
        <a href="#"><<</a>
        <a href="#"><</a>
        <a href="#" class="tagDisabled">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a>...</a>
        <a href="#">1654</a>
        <a href="#">></a>
        <a href="#">>></a>
      </span>
            <!-- Side pannel -->
            @include('components/sidePanel')


                <!-- Galeria obrazkov -->
            <main class="col-xl-10 col-lg-9 col-12 order-lg-2 order-1">
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


            <span class="pagesNavigator container-fluid order-2">
        <a href="#"><<</a>
        <a href="#"><</a>
        <a href="#" class="tagDisabled">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a>...</a>
        <a href="#">1654</a>
        <a href="#">></a>
        <a href="#">>></a>
      </span>
        </div>
    </div>


    <script src="{{asset('js/numberColour.js')}}"></script>
    <script>
        let imagesScoreVals = document.getElementsByClassName("score_number")
        for (let score of imagesScoreVals){
            colour(score)
        }
    </script>
</x-topBar>
