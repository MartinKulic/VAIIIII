<?php $rating = $submission->getRatingInfo() ?>


<x-topBar>

    <div class = container-fluid>
        <div class="row">

            <!-- Side pannel -->
            @include('components/sidePanel')

            <main class="col-xl-10 col-lg-9 col-12 m-xl-0 m-lg-0 m-0 order-lg-2 order-1">

                <div class="mainImage flex-fill">

                    <div class="align-items-center flex-fill mt-2">
                        <div type="button" data-toggle="modal" data-target="#exampleModal">
                            <img id="mImage" class="col-12" alt="Hlavny obrazok" src="{{asset('storage/' . $submission->getImage()->path)}}">
                        </div>
                    </div>
                    <div class="flex-row mt-3 d-flex justify-content-between">
                        <div class="col">
                            <span id="voteUpCount" class="green"><?= $rating->getUp() ?></span>
                            <button id="voteUp" class=" btn btn-<?php if (!($rating->getCurUserVote() > 0) ){ ?><?="outline-"?><?php } ?>success ">
                                <span class="spinner-border fs-3 d-none" aria-hidden="true"></span>
                                <i class="bi bi-hand-thumbs-up fs-3"></i>
                            </button>
                            <span id="scoreVal" class="mx-2 h4 align-middle"><?= $rating->getScore() ?></span>
                            <button id ="voteDown" class="btn btn-<?php if (!($rating->getCurUserVote() < 0) ){ echo "outline-"; } ?>danger ">
                                <span class="spinner-border fs-3 d-none" aria-hidden="true"></span>
                                <i class="bi-hand-thumbs-down fs-3"></i></button>
                            <span id="voteDownCount" class="red"><?= $rating->getDown() ?></span>
                            <button id="favBtn" class="mx-lg-5 mx-1 btn btn-<?php if(!$submission->getIsFaved()) { echo "outline-";} ?>warning ">
                                <span class="spinner-border fs-3 d-none" aria-hidden="true"></span>
                                <i class="bi bi-heart fs-3">
                                </i></button>
                        </div>
                        <!-- Edit button only if you are author -->
                        @can('update', $submission->getImage())
                        <div class="d-flex align-items-stretch">
                            <a href="{{route('image.edit', ["image" => $submission->getImage()])}}" class="btn btn-primary d-flex align-items-center">
                                <span class="h5 mb-1"> <i class="bi bi-pencil"></i> Edit </span></a>
                        </div>
                        @endcan
                    </div>
                    <div class="row mt-3">
                        <div class="col pt-0 pb-3 px-3 bg-body-secondary">
                            <div class="row d-inline">
                                <h4>{{ $submission->getImage()->name }}</h4>
                                <p class="fs-6">By <a class="fs-6 link-body-emphasis link-underline-success link-offset-2 link-underline-opacity-75-hover" href="{{route('profile', ["userID"=>$submission->getAutorId(), "what"=>"Nahrane"])}}">{{ $submission->getAutorName() }}</a></p>
                            </div>
                            <p class = "text-break">
                                {{  $submission->getImage()->desc }}
                            </p>
                            <input id="image_id" type="hidden" name="sub_id" value="{{ $submission->getImageId() }}">
                        </div>
                    </div>


                </div>

            </main>


        </div>
    </div>


</x-topBar>

<!-- Obrazok na celu obrazovku -->
<div id="fullscreen" class="fullscreen position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center d-none unfocuseBackground">
    <img src="{{ asset('storage/' . $submission->getImage()->path) }}" alt="zväčšený obrázok">
</div>

<script src="{{asset('js/numberColour.js')}}"></script>
<script src="{{asset('js/comunication.js')}}"></script>
<script src="{{asset('js/rating.js')}}"></script>
<script src="{{asset('js/faving.js')}}"></script>
<script>
    let scoreVal = document.getElementById("scoreVal")
    colour(scoreVal)
    let rat = new Rating()
    let fav = new Faving()
</script>
<script src="{{asset('js/imgFullscreen.js')}}"></script>

