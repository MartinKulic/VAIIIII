class Faving{

    #favButtonFav = document.getElementById("favBtn")

    #image_id = document.getElementById("image_id").value

    constructor() {
        this.#favButtonFav.addEventListener("click", ()=>this.sendToggle())
    }

    async sendToggle(){
        let response = await sendRequest({
            imgID: this.#image_id
        }, "fav");

        if(isResponseGood(response, "Len prihlaseny pouzivatelia mozu mat svoje oblubene obrazky")){
            response.json().then((r)=>(this.updateFav(r)))
        }
    }
    updateFav(response){
        if(response["faved"]===true){
            this.#favButtonFav.classList.remove("btn-outline-warning")
            this.#favButtonFav.classList.add("btn-warning")
            showTimedAllert("Uspene pridany medzi oblubene", 1000, "success")
        }
        else
        {
            this.#favButtonFav.classList.remove("btn-warning")
            this.#favButtonFav.classList.add("btn-outline-warning")

            showTimedAllert("Uspene odstranene z oblubenych", 1000, "secondary")
        }
    }
}
