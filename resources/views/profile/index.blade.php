<x-topBar>
        <div class="container">
            <div class="row d-flex d-flex justify-content-between">
                <div class="col">
                    <span class="h1">{{ $user->name }}</span>
                    <span class="h4  position-relative">@switch($userRole )
                            @case('Admin')
                                <span class="position-absolute top-0 start-100 translate-middle-y badge rounded-pill bg-danger">admin</span>
                                @break
                            @case('Restricted')
                                <strong class="position-absolute top-0 start-100 translate-middle-y badge rounded-pill bg-warning">restricted</strong>
                                @break
                        @endswitch</span>
                    @can("changeRole", $user)
                        <div>
                            <form method="post" action="{{route("profile.changeRole")}}" enctype="multipart/form-data">
                                @csrf
                                @method("post")

                                <input type="hidden" name="userID" value="{{request("userID")}}">

                                <div class="d-flex flex-row align-items-center">
                                    <label for="newRoleSelect">Rola:</label>
                                    <select name="newRole" id="newRoleSelect" class="form-select mx-3" aria-label="">
                                        <option value="Normal" <?php if($userRole==="Normal") {echo "selected";} ?> >Normal</option>
                                        <option class="bg-warning text-dark" value="Restricted" <?php if($userRole==="Restricted") {echo "selected";} ?> >Restricted</option>
                                        <option class="bg-danger" value="Admin" <?php if($userRole==="Admin") {echo "selected";} ?> >Admin</option>
                                    </select>

                                    <div class="col">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#confirmRoleChangeModal">Change</button>
                                    </div>
                                </div>

                                <!-- Conform dialog -->
                                <div class="modal fade" id="confirmRoleChangeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Si si isty?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Naozaj chces zmenit roulu pouzivatelovy <strong>{{$user->name}}</strong> z <span class="badge text-bg-light">{{$userRole}}</span> na <span id="badgeNewRole" class="badge text-bg-light"></span> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvor</button>
                                                <button type="submit" class="btn btn-primary">Ano zmen</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                    @endcan

                </div>
                <div class="col d-flex justify-content-end align-items-center">
                    <ul class="nav nav-pills  ">
                        <li class="nav-item">
                            <a class="nav-link <?php if (request("what")!="Fav") {echo('active'); } ?> " aria-current="page" href="{{route('profile', ["userID"=>request("userID"), "what"=>"Nahrane"])}}">Nahrane</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (request("what")=="Fav") {echo('active'); } ?>" href="{{route('profile', ["userID"=>request("userID"), "what"=>"Fav"])}}">Oblubene</a>
                        </li>
                        @can("manageReports", Auth::user())
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="{{route('reports')}}">Reports</a>
                        </li>
                        @endcan
                    </ul>
                </div>

            </div>
        </div>
        <hr class="hr">

        <main class="col-12 order-lg-2 order-1">

            @foreach($images as $image)
                @include("profile/partials/normal-image-view")
            @endforeach

        </main>

        <div class="row d-flex justify-content-center align-items-center align-self-center text-center">
            <div class="col d-flex d-flex justify-content-center align-items-center align-self-center text-center">
                {{$images->links()}}
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
<script>
    const roleSelct = document.getElementById("newRoleSelect")
    const newRoleBadge = document.getElementById("badgeNewRole")

    newRoleBadge.textContent = roleSelct.value

    roleSelct.addEventListener("change", ()=>{
        newRoleBadge.textContent=roleSelct.value
    })
</script>
