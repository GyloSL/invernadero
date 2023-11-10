<?php 
    //Archivo bd_usuarios que cuenta con las consultas
    //de base de datos de la tabla usuarios
    require_once "./php/bd_usuarios.php";
    session_start();
    //Si no hay una sesión iniciada se devuelve a la pagina
    //de login
    if (!isset($_SESSION["usuario"])){
        header("Location: /");
    //Si hay una sesion iniciada pero no tiene rol de administrador
    //se devuelve a la pagina principal
    } elseif (!($_SESSION["rol"] == "0")) {
        header("Location: principal.php");
    }

    //variable crear para mostrar mensaje en los siguientes casos
    //crear = 0 entonces no se muestra ningun mensaje
    //crear = 1 entonces se muestra mensaje de que se creo el usuario
    //crear = -2 las constraseñas no coinciden
    //crear = -1 faltó llenar los campos
    $crear = "0";
    if (isset($_POST["usuario"])) {
        //si todos los campos tienen valores
        if ($_POST["usuario"] != "" && $_POST["password"] != "" && $_POST["cpassword"] != "" && $_POST["rol"] != ""){
            //Si las contraseñas coinciden entonces se crea el usuario
            if ($_POST["password"] == $_POST["cpassword"]){
                //se crea el usuario
                crear($_POST["usuario"], $_POST["password"], $_POST["rol"], 1);
                $crear = "1";
            } else { //Las contraseñas no coinciden, no se crea el usuario
                $crear = "-2";
            }
        } else { //los campos no están llenos, no se crea el usuario
            $crear = "-1";
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
        <div class="agregar-principal">
            <h1 class="texto">Crear usuario</h1>
            
            <form class="agregar-form" method="post">
                <div class="agregar-campos"> 
                    <h2 class="texto4">Nombre de usuario</h2> 
                    <input type="text" name="usuario" class="textbox" placeholder="Escriba el nombre de usuario">
                    <h2 class="texto4">Contraseña</h2> 
                    <input type="password" name="password" class="textbox" placeholder="Escriba la contraseña">
                    <h2 class="texto4">Confirmar contraseña</h2> 
                    <input type="password" name="cpassword" class="textbox" placeholder="Escriba la contraseña">
                    <h2 class="texto4">Rol de usuario</h2> 
                    <select name="rol" class="textbox" id="rol">
                        <option value="1">Monitoreo</option>
                        <option value="0">Administrador</option>
                    </select>
                </div>
                <?php 
                if ($crear == "-1") {
                    echo "<b2 style='color: whitesmoke' class='texto'>Llene todos los campos</b2>";
                } elseif ($crear == "-2") {
                    echo "<b2 style='color: whitesmoke' class='texto'>Las contraseñas no coinciden</b2>";
                } elseif ($crear == "1") {
                    echo "<b2 style='color: whitesmoke' class='texto'>Se agregó un usuario</b2>";
                }
                ?>
                <input type="submit" value="Crear usuario" class="boton">
            </form>
        </div>
    </div>
</body>
</html>