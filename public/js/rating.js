class Rating{
    #upElement = document.getElementById("voteUp")
    #downElement = document.getElementById("voteDown")
    #voteUpCount = document.getElementById("voteUpCount")
    #voteDownCount =document.getElementById("voteDownCount")
    #scoreVal = document.getElementById("scoreVal")

    #image_id = document.getElementById("image_id").value


    constructor() {
        this.#upElement.addEventListener("click", ()=>this.vote(1))
        this.#downElement.addEventListener("click", ()=>{this.vote(-1)})
    }

    async vote(value)
    {
        let response = await this.sendReques({
            voted: value,
            imgID: this.#image_id
        });

        if(response.status !== 200)
        {
            console.log("Chyba")
            console.log(response.status)

            if(response.status === 401)
            {
                console.log("Iba prihlaseny mozu hodnotit")
                showTimedAllert("Iba prihlaseny mozu hodnotit", 3000, "warning")
            }
        }
        else {
            response.json().then((r)=>(this.updateRating(r)))
        }
    }
    async updateRating(rating){
        //voted UP
        if(rating["curUserVote"] > 0){
            this.#upElement.classList.add("btn-success")
            this.#upElement.classList.remove("btn-outline-success")
            this.#downElement.classList.add("btn-outline-danger")
            this.#downElement.classList.remove("btn-danger")
        }
        else if(rating["curUserVote"] < 0){
            this.#upElement.classList.remove("btn-success")
            this.#upElement.classList.add("btn-outline-success")
            this.#downElement.classList.remove("btn-outline-danger")
            this.#downElement.classList.add("btn-danger")
        }
        else if (rating["curUserVote"]===0){
            this.#upElement.classList.replace("btn-success","btn-outline-success")
            this.#downElement.classList.replace("btn-danger","btn-outline-danger")
        }

        this.#scoreVal.textContent = rating["score"]
        colour(this.#scoreVal)

        this.#voteUpCount.textContent=rating["up"]
        this.#voteDownCount.textContent=rating["down"]
    }

    async sendReques(body) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let url = "http://localhost/image/"+this.#image_id+"/rate" //http://127.0.0.1/?c=submission&a=rate
        try {

            let response = await fetch(
                url,
                {
                    method: "POST",
                    body: JSON.stringify(body),
                    headers: {
                        "Content-type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    }
                })

            // if (response.status !== 200){
            //     throw new Error("Wrong Response", response)
            // }

            return response //.json()
        } catch (ex) {

            return ex;
        }
    }

}
