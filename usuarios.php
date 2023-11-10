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

    //Ir a editar un usuario 
    if (isset($_POST["Edit"])){
        //Se guarda el nombre del usuario a editar en la sesion
        $_SESSION["editar"] = $_POST["Edit"];
        header("Location: editarUsuario.php");
    }

    //variable disable para mostrar mensaje
    //Si es 0 no se muestra ningun mensaje
    //Si es -1 quiere decir que se quiere deshabilitar el usuario
    //con el que se encuentra actualmente en sesión por lo que no
    //se hace la funciona de deshabilitar usuario
    $disable = "0";
    //Se ve si se hace un post para deshabilitar
    if (isset($_POST["Disable"])){
        //Si el usuario a deshabilitar es igual al usuario con el 
        //que se está iniciado sesión no se hace la funcion
        if ($_POST["Disable"] == $_SESSION["usuario"]){
            $disable = "-1"; //-1 para mostrar mensaje de error
        } else {
            inhabilitar($_POST["Disable"]); // Se inhabilita el usuario
        }
    } 

    //Se ve si se hace un post para habilitar  un usuario
    if (isset($_POST["Enable"])) {
        habilitar($_POST["Enable"]); //Se habilita el usuario
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
        <div class="usuarios-principal">
            <div class="usuarios-agregar">
                <h2 class="texto4">Usuarios</h2>
                <h3 class="texto3">Agregar usuario</h3>
                <a href="agregarUsuario.php" class="a"><button class="agregar"></button></a>
                
            </div>
            <form class="usuarios-mostrar" id="mostrar-usuarios" method="post">
            
            </form>
            <?php 
                if ($disable == "-1") {
                    echo "<b2 style='color: whitesmoke' class='texto'>No se puede deshabilitar la sesion actual</b2>";
                } 
            ?>
        </div>
    </div>
</body>
<script src="js/cargarUsuarios.js"></script>   
</html>