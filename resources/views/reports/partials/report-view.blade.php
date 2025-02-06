<?php
?>


<a class="strippedLink" href="{{route('image.detail', ['imgID'=>$report->getImage()->id])}}">
    <div class="container mb-3" onclick=>
        <div class="row ">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row profileSubInfo">
                    <!-- Obrázok -->
                    <div class="col-md-4 imgColProfile">
                        <img src="{{asset('storage/'. $report->getImage()->path)}}" class="img-fluid object-fit-cover" alt="Obrázok">
                    </div>
                    <!-- Obsah -->
                    <div class="col-md-8 p-3 d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between">
                            <h2 class="mb-4"></h2>
                            <span class="rating">
                                            <span class="green"> <i class="bi bi-caret-up"></i></span >
                                            <span class="score_number">{{ \App\Models\Rating::getRatingValueFor($report->getImage()->id) }} </span>
                                            <span class="red"><i class="bi bi-caret-down"></i></span >
                                        </span>
                        </div>
                        <p class="imgDescInProfile">
                            {{$report->getReport()->reason}}
                        </p>
                        <div class="flex-row d-flex justify-content-end">
                            <div class = "col d-flex"></div>
                            <span>
                                <a href="{{route("report.cancel", ["repID"=>$report->getReport()->id])}}" class="btn btn-outline-success mx-3">
                                    <span class="spinner-border fs-3 d-none" aria-hidden="true"></span>
                                    <i class="bi bi-check-lg"></i>
                                </a>
                            </span>
                            <div>
                                <form action="{{ route('image.destroy', $report->getImage()->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')

                                                <button class="btn btn-outline-danger">
                                                    <span class="spinner-border fs-3 d-none" aria-hidden="true"></span>
                                                    <i class="bi bi-trash"></i>
                                                </button>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>

