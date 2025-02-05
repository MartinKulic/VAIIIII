class Rating{
    #upElement = document.getElementById("voteUp")
    #upIcon = this.#upElement.getElementsByTagName("i")[0]
    #upSpinner = this.#upElement.getElementsByTagName("span")[0]

    #downElement = document.getElementById("voteDown")
    #downIcon = this.#downElement.getElementsByTagName("i")[0]
    #downSpinner = this.#downElement.getElementsByTagName("span")[0]

    #voteUpCount = document.getElementById("voteUpCount")
    #voteDownCount =document.getElementById("voteDownCount")
    #scoreVal = document.getElementById("scoreVal")

    #image_id = document.getElementById("image_id").value


    constructor() {
        this.#upElement.addEventListener("click", ()=>{
            this.#upIcon.classList.add("d-none")
            this.#upSpinner.classList.remove("d-none")
            this.vote(1).then(()=>{
                this.#upIcon.classList.remove("d-none")
                this.#upSpinner.classList.add("d-none")
            })

        })
        this.#downElement.addEventListener("click", ()=>{
            this.#downIcon.classList.add("d-none")
            this.#downSpinner.classList.remove("d-none")
            this.vote(-1).then(()=>{
                this.#downIcon.classList.remove("d-none")
                this.#downSpinner.classList.add("d-none")
            })
        })
    }

    async vote(value)
    {
        let response = await sendRequest({
            voted: value,
            imgID: this.#image_id
        }, "image/"+this.#image_id+"/rate");

        if(isResponseGood(response, "Iba po prihlaseni je mozne hodnotit"))
        {
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



}
