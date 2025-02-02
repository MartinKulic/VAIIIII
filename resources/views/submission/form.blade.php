
<div class="row justify-content-center">
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
                {{$error}}
        </div>
    @endforeach
</div>


<div class="row justify-content-center">
    <div class="col-12 col-md-6 order-md-1 order-2">

        <form method="post" action="{{$action}}" enctype="multipart/form-data">
            @csrf
            @method($method)

            <input type="hidden" name="imgID" value="{{old('id', @$model->id)}}">

            @if ($purpose == "add")
            <label for="imageInput">Image:</label>
            <div class="form-group">
                <input name="image" type="file" class="form-control-file" id="imageInput" accept=".jpg,.gif,.png" required>
            </div>
            @endif

            <div class="form-grupe mt-3">
                <label for="titleInput">Title:</label>
                <input name="title" class="form-control form-control-lg" id="titleInput" aria-describedby="emailHelp" placeholder="Title"  autocomplete="off" required
                       value="{{old('title', @$model->name)}}">
                <small id="emailHelp" class="form-text text-muted">What is the title of image</small>
            </div>

            <div class="input-grupe mt-3">
                <label for="descInput">Description:</label>
                <textarea name="desc" class="form-control" id="descInput" placeholder="Description of image">{{old('desc', @$model->desc)}}</textarea>
                <small id="emailHelp" class="form-text text-muted">Description of image</small>
            </div>

            <div class="input-grupe mt-3">
                <label for="capInput">Caption:</label>
                <textarea name="capt" class="form-control" id="capInput" placeholder="Ak obrazok obsahuje nejaky relevantny text pokus sa ho prepisat sem">{{old('capt', @$model->caption)}}</textarea>
                <small id="emailHelp" class="form-text text-muted">Ak obrazok obsahuje nejaky relevantny text pokus sa ho prepisat sem</small>
            </div>

{{--            <div class="input-grupe mt-3">--}}
{{--                <label for="tagInput">Tagy</label>--}}
{{--                <textarea name="tag" class="form-control" id="tagInput"><?php--}}
{{--                                                                        if (!is_null($submission)) :--}}
{{--                                                                            foreach ($submission?->getImageTags() as $tag) :?><?=$tag?><?php endforeach; endif;?></textarea>--}}
{{--                <small id="emailHelp" class="form-text text-muted">Tags for image</small>--}}
{{--            </div>--}}


            <div class="row mt-4 flex-row-reverse">
                <div class="col-4 text-end">
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

                @if ($purpose == "edit")
                <div class="col-4 text-end mx-4">
                    <div class="row">
                        <button id="delBut" type="button" class="btn btn-outline-danger">Delete</button>
                    </div>
                </div>
                @endif
            </div>
            @if ($purpose == "edit")
            <div id="confirmButton" class="d-none">
                <div class="row mt-2 flex-row-reverse">
                    <div class="col-4"></div>
                    <div class="col-4 ext-end mx-4">
                        <div class="row">
                            <form action="{{ route('image.destroy', $model->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Really?</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </form>
    </div>

    <div class="col-12 col-md-6 order-md-2 order-1 align-items-center align-self-center text-center">
        <img id="imagePreview" class="mw-100 mh-100" src="{{@old('path', asset('storage/'.@$model->path))}}" alt="Image Preview">
    </div>

</div>

@if ($purpose == "edit")
<script>
    let confirmButton = document.getElementById("confirmButton")
    let delButton = document.getElementById("delBut")

    delButton.addEventListener("click", () => {
        confirmButton.classList=[]
    })
</script>
@elseif ($purpose == "add" )

<script src=" {{asset('js/showImgPreview.js')}}"></script>

@endif
