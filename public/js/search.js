var searchCaptionBtn = document.getElementById("searchByCaption")
var searchCaptionTextField = document.getElementById("captionFilter")
var searchCaptionEmptySearch = document.getElementById("searchByCaptionEmplpty")

var searchTagBtn = document.getElementById("searchByTag")
var searchTagTextField = document.getElementById("tagSearch")
var searchTagEmptySearch = document.getElementById("searchByTag")

var searchBooth = document.getElementById("btnSearchCaptTag")
var emptyBooth = document.getElementById("btnClearFilters")

function searchGetRequest(caption, tags){
    const params = new URLSearchParams();
    if (caption) params.append("caption", caption);
    if (tags) {
        tags.forEach(tag => params.append("tags[]", tag));
    }
    window.location.href = `/s?${params.toString()}`;
}

searchCaptionEmptySearch.addEventListener("click", () =>{
    searchCaptionTextField.value = ""
})

searchCaptionBtn.addEventListener("click", ()=>{
    searchGetRequest(searchCaptionTextField.value.trim(), null)
})


emptyBooth.addEventListener("click", ()=>{
    searchTagTextField.value = ""
    searchCaptionTextField.value = ""
})

searchBooth.addEventListener('click', ()=>{
    searchGetRequest(searchCaptionTextField.value.trim(), searchTagTextField.value.trim()?.split(" "))
})
