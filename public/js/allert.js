//Vyzaduje element alertBar

function showTimedAllert(message, time, type = "warning")
{
    let bar = document.getElementById("alertBar")
    if (bar==null)
    {
        console.log("Nenasiel element s id alertBar")
        return null
    }

    let alertBox = document.createElement("div");
    alertBox.className = "alert fade show  alert-" + type
    alertBox.role = "alert"
    // alertBox.innerHTML = '<div class="flex-row d-flex justify-content-between align-items-center">' +
    //     '   <span>' +
    //     '       <div class="col">' +
    //     '           ' + message +
    //     '       </div>' +
    //     '   </span>' +
    //     // '   <span class="cancelAlertButton">' +
    //     // '       <a class="h3 text-white" onclick="dismissAlert(alertBox)">X</a>' +
    //     // '   </span>' +
    //     '</div>'

    let obal = document.createElement("div")
    obal.className = "flex-row d-flex justify-content-between align-items-center"
    obal.innerHTML = '   <span>' +
        '       <div class="col">' +
        '           ' + message +
        '       </div>' +
        '   </span>'


    let butn = document.createElement("span")
    butn.innerHTML = '<span class="h3 text-white" aria-hidden=\"true\">&times;</span>'
    butn.className = "cancelAlertButton"
    butn.labels="Close"

    butn.addEventListener("click", () => dismissAlert(alertBox))

    obal.appendChild(butn)
    alertBox.appendChild(obal)
    bar.appendChild(alertBox)

    setTimeout(()=>{
        //$(".alert").alert('close')
        dismissAlert(alertBox)
    }, time)
}

function dismissAlert(alert)
{
    alert.classList.remove("show")
    setTimeout(()=>{
        alert.remove()
    }, 1000)
}
