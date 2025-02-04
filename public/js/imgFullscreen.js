let img = document.getElementById("mImage")
let fullscreenImg =document.getElementById("fullscreen")

fullscreenImg.addEventListener('click', () => {
    fullscreenImg.classList.add("d-none")
})
img.addEventListener("click", ()=>{
    fullscreenImg.classList.remove("d-none")
})
