<?php
    session_start();

    //Si no hay una sesión iniciada se devuelve a la pagina
    //de login
    if (!isset($_SESSION["usuario"])){
        header("Location: /");
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
        <div class="grafica-principal">
            <div id="chartHA"></div>
            <div id="chartHS"></div>
            <div id="chartTA"></div>
            <div id="chartTS"></div>
        </div>
    </div>
</body>
<script src="https://d3js.org/d3.v6.min.js"></script>
<script src="js/billboard.js"></script>
<script src="js/grafica.js"></script>   
</html>