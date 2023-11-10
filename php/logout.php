<?php 
    //Cierra la sesión del usuario y lo
    //envia a la pagina de login
    session_start();
    unset($_SESSION["usuario"]);
    header("Location: /");
?>