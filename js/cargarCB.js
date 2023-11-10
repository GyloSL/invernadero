async function cargar(fecha){
    const cb = document.getElementById("jsHora").textContent = '';
    url = "/php/cargarCB.php?fecha=" + fecha;
    let response = await fetch(url);

    if (response.ok) { // if HTTP-status is 200-299
        // get the response body (the method explained below)
        let array = (await response.text()).split(',');
        console.log(array);
        array.forEach(add);
    } else {
    alert("HTTP-Error: " + response.status);
    }
}

function add(hora){
    const cb = document.getElementById("jsHora");
    const opcion = document.createElement("option");
    opcion.value = hora;
    opcion.innerHTML = hora;
    cb.append(opcion);
}