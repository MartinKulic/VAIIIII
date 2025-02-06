<?php
    ?>


                <a class="strippedLink" href="{{route('image.detail', ['imgID'=>$image->id])}}">
                <div class="container mb-3" onclick=>
                    <div class="row ">
                        <div class="col-12">
                            <div class="d-flex flex-column flex-md-row profileSubInfo">
                                <!-- Obrázok -->
                                <div class="col-md-4 imgColProfile">
                                    <img src="{{asset('storage/'. $image->path)}}" class="img-fluid object-fit-cover" alt="Obrázok">
                                </div>
                                <!-- Obsah -->
                                <div class="col-md-8 p-3 d-flex flex-column">
                                    <div class="d-flex justify-content-between">
                                        <h2 class="mb-4">{{$image->name}}</h2>
                                        <span class="rating">
                                            <span class="green"> <i class="bi bi-caret-up"></i></span >
                                            <span class="score_number">{{ \App\Models\Rating::getRatingValueFor($image->id) }} </span>
                                            <span class="red"><i class="bi bi-caret-down"></i></span >
                                        </span>
                                    </div>
                                    <p class="imgDescInProfile">
                                        {{$image->desc}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>

