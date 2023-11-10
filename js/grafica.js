var chart = null;

cargar();

function generarGrafica(id, ...columnas){
    chart = bb.generate({
        size: {
            width: 400,
            height: 250,
        },
        data: {
            columns: [...columnas],
            type: "line", // for ESM specify as: line()
        },
        bindto: id
    });
}

async function cargar(){
    url = "/php/cargarGrafica.php?obtener=si";
    let response = await fetch(url);

    if (response.ok) {
        array = JSON.parse(await response.text());
        console.log(array);
        HA = String(array["HA"]).split(',');
        HS = String(array["HS"]).split(',');
        TA = String(array["TA"]).split(',');
        TS = String(array["TS"]).split(',');
        generarGrafica('#chartHA', ["Humedad ambiente", ...HA]);
        generarGrafica('#chartHS', ["Humedad suelo", ...HS]);
        generarGrafica('#chartTA', ["Temperatura ambiente", ...TA]);
        generarGrafica('#chartTS', ["Temperatura suelo", ...TS]);
        console.log(chart);
    } else {
        alert("HTTP-Error: " + response.status);
    }
}