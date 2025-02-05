<?php

?>
<link rel="stylesheet" href="{{asset('awesomplete/awesomplete.css')}}" />
<script src="{{asset('awesomplete/awesomplete.js')}}" async></script>

<aside class="col-xl-2 col-lg-3 order-lg-1 order-3 p-2 sideBar">

{{--    <form>--}}
        <label>Caption vyhladavanie</label>
        <div class="input-group mb-2 align-self-center">
              <button id="searchByCaption" class="input-group-text">
                <i class = "bi-search"></i>
              </button>
            <textarea id="captionFilter" class="form-control" aria-label="Caption search">{{request("caption")}}</textarea>
            <button id="searchByCaptionEmplpty" class="input-group-text">&times</button>
        </div>
        <label>Tag vyhladavanie</label>
        <div class="input-group mb-2 align-self-center">
              <button id="searchByTag" class="input-group-text">
                <i class = "bi-search"></i>
              </button>
            <textarea id="tagSearch" class="form-control" aria-label="Tag search">NEFUNKCNE{{ collect(request('tags', []))->join(' ') }}</textarea>
            <button id="tagSearchEmpty" class="input-group-text">&times</button>
        </div>
        <!-- Aktivne vo filtry -->
        <div class="row">
            <h3 class="col align-items-start">Aktývny Filter</h3>
            <button id="btnClearFilters" class="col-3 me-1 btn-danger align-items-end">Zruš filtere</button>
            <button id="btnSearchCaptTag" class="col-2 me-3 btn-danger align-items-end"><i class = "bi-search"></i></button>
        </div>

{{--    </form>--}}

    <ul class="mt-2 p-2 zoznamTags container-fluid justify-content-center">
        <li class="tagRow mt-1 p-1 wighterBackground">
            <a href="#" class="me-2 tagInfo"><i class="bi-info-square"></i></a>
            <a href="#"><i class="bi-clipboard-plus tagDisabled"></i></a>
            <a href="#"><i class="bi-clipboard-minus red"></i></a>
            <a href="#" class="ms-2">Pes</a>
        </li>
        <li class="tagRow mt-1 p-1 wighterBackground">
            <a href="#" class="me-2 tagInfo"><i class="bi-info-square"></i></a>
            <a href="#"><i class="bi-clipboard-plus tagDisabled"></i></a>
            <a href="#"><i class="bi-clipboard-minus red"></i></a>
            <a href="#" class="ms-2">Mačka</a>
        </li>
        <li class="tagRow mt-1 p-1 wighterBackground">
            <a href="#" class="me-2 tagInfo"><i class="bi-info-square"></i></a>
            <a href="#"><i class="bi-clipboard-plus tagDisabled"></i></a>
            <a href="#"><i class="bi-clipboard-minus red"></i></a>
            <a href="#" class="ms-2">Sample</a>
        </li>
        <li class="tagRow mt-1 p-1 wighterBackground">
            <a href="#" class="me-2 tagInfo"><i class="bi-info-square"></i></a>
            <a href="#"><i class="bi-clipboard-plus tagDisabled"></i></a>
            <a href="#"><i class="bi-clipboard-minus red"></i></a>
            <a href="#" class="ms-2">Unfunny</a>
        </li>
    </ul>
    <!-- Tiez sa vyskytujuce Tagy -->
    <hr class="hr">
    <h3>Tiež sa vyskytujúce</h3>
    <ul class="mt-2 p-2 zoznamTags wighterBackground justify-content-center">
        <li class="tagRow mb-1">
            <a href="#" class="me-2 tagInfo"><i class="bi-info-square"></i></a>
            <a href="#"><i class="bi-clipboard-plus green"></i></a>
            <a href="#"><i class="bi-clipboard-minus red"></i></a>
            <a href="#" class="ms-2">Žmurkanie</a>
        </li>
        <li class="tagRow mb-1">
            <a href="#" class="me-2 tagInfo"><i class="bi-info-square"></i></a>
            <a href="#"><i class="bi-clipboard-plus green"></i></a>
            <a href="#"><i class="bi-clipboard-minus red"></i></a>
            <a href="#" class="ms-2">Ospalosť</a>
        </li>
        <li class="tagRow mb-1">
            <a href="#" class="me-2 tagInfo"><i class="bi-info-square"></i></a>
            <a href="#"><i class="bi-clipboard-plus green"></i></a>
            <a href="#"><i class="bi-clipboard-minus red"></i></a>
            <a href="#" class="ms-2">Smutlý</a>
        </li>
        <li class="tagRow mb-1">
            <a href="#" class="me-2 tagInfo"><i class="bi-info-square"></i></a>
            <a href="#"><i class="bi-clipboard-plus green"></i></a>
            <a href="#"><i class="bi-clipboard-minus red"></i></a>
            <a href="#" class="ms-2">Štastný</a>
        </li>
        <li class="tagRow mb-1">
            <a href="#" class="me-2 tagInfo"><i class="bi-info-square"></i></a>
            <a href="#"><i class="bi-clipboard-plus green"></i></a>
            <a href="#"><i class="bi-clipboard-minus red"></i></a>
            <a href="#" class="ms-2">Podozieravy</a>
        </li>

    </ul>
</aside>

<script src="{{asset('js/search.js')}}"></script>
