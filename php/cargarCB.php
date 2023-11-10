<?php
    $server = "127.0.0.1";
    $database = "invernadero";
    $user = "sa";
    $pas = "Admin_123";
    $fecha = $_GET["fecha"];    
    //Se conecta a la base de datos
    $con = mysqli_connect($server, $user, $pas, $database);
    //Variable array para crear una string con formato de 
    //arreglo con las horas de x fecha
    //se manda usa array en cargarCB.js
    $array = "";
    if(!$con){
        echo "falló la conexión a la base de datos";
    } else {
        $query = "SELECT hora FROM estados WHERE fecha='$fecha'";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($result)){
            $array = $array . $row["hora"];
            $array = $array . ",";
        }  
        $array = substr($array, 0, -1);
        echo $array;
    } 
?>