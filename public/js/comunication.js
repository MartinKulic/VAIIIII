async function sendRequest(body, route) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let url = "http://localhost/"+ route //http://127.0.0.1/?c=submission&a=rate
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

function isResponseGood(response){
    if(response.status !== 200)
    {
        console.log("Chyba")
        console.log(response.status)

        if(response.status === 401)
        {
            console.log("Iba prihlaseny mozu hodnotit")
            showTimedAllert("Iba prihlaseny mozu hodnotit", 3000, "warning")
        }
        return false
    }
    return true
}
