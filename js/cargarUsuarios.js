
const tabla = document.getElementById("mostrar-usuarios");

async function cargar(){
    url = "/php/cargarUsuarios.php?obtener=si";
    let response = await fetch(url);

    if (response.ok) {
        let array = JSON.parse(await response.text());
        console.log(array);
        document.documentElement.style.setProperty('--x1', array.length);
        array.forEach(add);
    } else {
        alert("HTTP-Error: " + response.status);
    }
}

function add(usuario){
    const username = document.createElement("h3");
    username.classList.add('texto4');
    username.innerHTML = usuario["username"];
    const editar = document.createElement("button");
    editar.type = "submit";
    editar.name = "Edit";
    editar.value = usuario["username"];
    editar.classList.add('editar');
    const enable_disable = document.createElement("button");
    enable_disable.type = "submit";
    enable_disable.value = usuario["username"];
    if (usuario["estatus"] == 0) {
        enable_disable.name = "Enable";
        enable_disable.classList.add("habilitar");
    } else {
        enable_disable.name = "Disable";
        enable_disable.classList.add("deshabilitar");
    }
    tabla.appendChild(username);
    tabla.appendChild(editar);
    tabla.appendChild(enable_disable);
}

cargar();