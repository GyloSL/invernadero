<?php
    //El arduino manda las condiciones a este archivo
    if(isset($_GET)) {
        $TS = $_GET["TS"]; //TS = Temperatura suelo
        $TA = $_GET["TA"]; //TA = Temperatura ambiente
        $HS = $_GET["HS"]; //HS = Humedad suelo
        $HA = $_GET["HA"]; //HA = Humedad ambiente

        //Se saca el porcentaje de humedad para guardar en
        //la base de datos
        $HS = round($HS / 1024 * 100, 2);
        $HA = round($HA / 1024 * 100, 2);

        date_default_timezone_set('America/Mazatlan');

        //Se obtiene la fecha y hora del sistema del servidor
        $fecha = date('Y-m-d');  
        $hora = date('h:i:s');

        $server = "127.0.0.1";
        $database = "invernadero";
        $user = "sa";
        $pas = "Admin_123";

        //Se conecta a la base de datos
        $con = mysqli_connect($server, $user, $pas, $database);
        $query = "INSERT INTO estados (fecha, hora, t_suelo, t_ambiente, h_suelo, h_ambiente, id_invernadero) VALUES ('$fecha', '$hora', '$TS', '$TA', $HS, '$HA', 1);";
        //Se hace la query para insertar las condiciones recibidas del arduino
        if($con->query($query) === TRUE){
            echo "si se guardó \n";
        } else {
            echo "no se guardó nada";
        }
    }
?>