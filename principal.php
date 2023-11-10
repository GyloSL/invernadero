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

    //Se conecta a la base de datos y se obtiene el ultimo registro
    //de condiciones del invernadero en la base de datos 
    $con = conectar();
    $query = "SELECT t_suelo, t_ambiente, h_suelo, h_ambiente FROM estados WHERE id_invernadero=1 ORDER BY id DESC LIMIT 1;";
    $result = $con->query($query);
    $row = $result->fetch_assoc();
    $TS = $row["t_suelo"]; // TS = Temperatura suelo
    $TA = $row["t_ambiente"]; // TA = Temperatura ambiente
    $HS = $row["h_suelo"]; // HS = Humedad suelo
    $HA = $row["h_ambiente"]; // HA = Humedad ambiente
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
        <div class="mostrar-estados">
            <h1 class="texto"> Condiciones </h1>
            <div class="mostrar-estados2"> 
                <h2 class="texto">Temperatura suelo</h2> <b1 class="estados"> <?php echo $TS . "˚C"?> </b1> 
                <h2 class="texto">Temperatura ambiente</h2> <b1 class="estados"> <?php echo $TA . "˚C"?> </b1> 
                <h2 class="texto">Humedad suelo</h2> <b1 class="estados"> <?php echo $HS . "%"?> </b1> 
                <h2 class="texto">Humedad ambiente</h2> <b1 class="estados"> <?php echo $HA . "%"?> </b1> 
            </div>
            <a href="principal.php" class="a"> <button class="boton">Solicitar ultimas condiciones</button> </a>
        </div>
    </div>
</body>
</html>