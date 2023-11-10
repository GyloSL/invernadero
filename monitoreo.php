<?php 
    //Archivo bd_usuarios que cuenta con las consultas
    //de base de datos de la tabla usuarios
    require_once "./php/bd_usuarios.php";
    session_start();

    //Si no hay una sesión iniciada se devuelve a la pagina
    //de login
    if (!isset($_SESSION["usuario"])){
        header("Location: /");
    }

    $TS = "N/A"; // TS = Temperatura suelo
    $TA = "N/A"; // TA = Temperatura ambiente
    $HS = "N/A"; // HS = Humedad suelo 
    $HA = "N/A"; //HA = Humedad ambiente

    //Si hay una peticion post de fecha y hora entonces
    //se busca en la base de datos las condiciones que hay en
    //esa fecha y hora y se muestran en pantalla
    if (isset($_POST["fecha"]) && isset($_POST["hora"])){
        $con = conectar();
        $fecha = date('Y-m-d', strtotime($_POST["fecha"]));
        $hora = $_POST["hora"];
        $query = "SELECT t_suelo, t_ambiente, h_suelo, h_ambiente FROM estados WHERE fecha = '$fecha' AND hora = '$hora' AND id_invernadero=1 ORDER BY id DESC LIMIT 1;";
        $result = $con->query($query);
        $row = $result->fetch_assoc();
        if ($row){
            $TS = $row["t_suelo"] . "˚C"; // TS = Temperatura suelo
            $TA = $row["t_ambiente"] . "˚C"; // TA = Temperatura ambiente
            $HS = $row["h_suelo"] . "%"; // HS = Humedad suelo 
            $HA = $row["h_ambiente"] . "%"; //HA = Humedad ambiente
        }
    }
?>

<html>
    <head> 
        <link rel="stylesheet" href="css/styles.css"> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
<body class="cuerpo">
    <div class="division-app">
        <?php 
        if ($_SESSION["rol"] == "0"){
            include "php/menuAdmin.php"; 
        } else {
            include "php/menu.php";
        }
        ?>
        <div class="monitoreo-estados">
            <h1 class="texto"> Condiciones </h1>
            <form class="monitoreo-estados2" method="post" id="monitoreo">
                <div class="monitoreo-estados3">
                    <h2 class="texto">Fecha: </h2> 
                    <input name="fecha" type="date" placeholder="Fecha" class="monitoreo-fecha" id="fecha" onchange="cargar(this.value)">
                    <h2 class="texto">Hora: </h2> 
                    <select name="hora" class="monitoreo-hora" id="jsHora">

                    </select>
                </div>
                <input type="submit" value="Solicitar condiciones" class="boton">
            </form>
            <div class="mostrar-estados2"> 
                <h2 class="texto">Temperatura suelo</h2> <b1 class="estados"> <?php echo $TS ?> </b1> 
                <h2 class="texto">Temperatura ambiente</h2> <b1 class="estados"> <?php echo $TA ?> </b1> 
                <h2 class="texto">Humedad suelo</h2> <b1 class="estados"> <?php echo $HS ?> </b1> 
                <h2 class="texto">Humedad ambiente</h2> <b1 class="estados"> <?php echo $HA ?> </b1> 
            </div>
        </div>
    </div>
</body>
<script src="js/cargarCB.js"></script>   
</html>