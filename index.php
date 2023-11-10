<?php 
    //se pone en pantalla si hay algun error en el codigo php
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    //Archivo bd_usuarios que cuenta con las consultas
    //de base de datos de la tabla usuarios
    require_once "./php/bd_usuarios.php";
    session_start();
    
    //Si ya hay una sesión iniciada se manda a la pagina
    //principal al usuario
    if(isset($_SESSION["usuario"])){
        header("Location: principal.php");
    //Si no hay una sesión iniciada entonces se revisa si
    //existe un usuario con la contraseña ingresada en la base
    //de datos por medio de la funcion login
    //En caso de existir un usuario con esos datos se regresa
    //el rol que tiene el usuario, 1 = monitoreo, 0 = administrador
    //y se manda a la pagina principal con una sesión con el nombre
    //de usuario y su rol en el sistema
    //Si no existe entonces se regresa un -1 y se le manda un mensaje
    //de que el usuario y/o contraseña son incorrectos 
    } else {
        $login = "3";
        if(isset($_POST["usuario"])) {
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            $login = login($usuario, $password);
            if (!($login == "-1")) {
                $_SESSION["usuario"] = $usuario;
                $_SESSION["rol"] = $login;
                header("Location: principal.php");
            } else {
                $login = "-1";
            }
        } 
    }
?>

<html>
    <head> 
        <link rel="stylesheet" href="css/styles.css"> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
<body class="cuerpo">
    <div class="centrar div-principal">
        <div class="div-login centrar">
           <h1 class="texto"> 3-03 IS Invernadero </h1>
            <form class="centrar" method="post">
                <h2 class="texto"> Usuario </h2>
                <input type="text" name="usuario" class="textbox" placeholder="Escribe tu nombre de usuario">
                <h2 class="texto"> Contraseña </h2>
                <input type="password" name="password" class="textbox" placeholder="Escribe tu constraseña">
                <?php 
                    if ($login === "-1") {
                        echo "<b2 style='color: whitesmoke' class='texto'> Usuario y/o contraseña incorrectos </b2>";
                    } 
                ?>
                <input type="submit" value="Iniciar sesión" class="boton">
            </form>
        </div>
    </div>
</body>
</html>
