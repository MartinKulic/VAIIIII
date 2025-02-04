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

        if(isResponseGood(response)){
            response.json().then((r)=>(this.updateFav(r)))
        }
    }
    updateFav(response){
        if(response["faved"]===true){
            this.#favButtonFav.classList.add("btn-warming")
            this.#favButtonFav.classList.remove("btn-outline-warning")
        }
        else
        {
            this.#favButtonFav.classList.remove("btn-warming")
            this.#favButtonFav.classList.add("btn-outline-warning")
        }
    }
}
