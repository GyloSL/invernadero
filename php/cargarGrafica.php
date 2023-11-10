<?php
    //Se cargan los datos de las condiciones en la grafica
    if (isset($_GET["obtener"])){
        $server = "127.0.0.1";
        $database = "invernadero";
        $user = "sa";
        $pas = "Admin_123";
   
        //Se conecta la base de datos
        $con = mysqli_connect($server, $user, $pas, $database);
        //Se crea una string con formato de arreglo de json 
        //cargarUsuarios.js recibe la string y la usa para 
        //cargar los usuarios en el modulo de usuarios
        $ha = "";
        $hs = "";
        $ta = "";
        $ts = "";
        $array = "";
        if(!$con){
             echo "falló la conexión a la base de datos";
        } else {
            $query = "SELECT h_ambiente, h_suelo, t_ambiente, t_suelo FROM estados WHERE id_invernadero=1";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                $ha = $ha . $row["h_ambiente"] . ",";
                $hs = $hs . $row["h_suelo"] . ",";
                $ta = $ta . $row["t_ambiente"] . ",";
                $ts = $ts . $row["t_suelo"] . ",";
            }  
            $ha = substr($ha, 0, -1);
            $hs = substr($hs, 0, -1);
            $ta = substr($ta, 0, -1);
            $ts = substr($ts, 0, -1);
            
            $array = '{"HA":"' . $ha . '","HS":"' . $hs . '","TA":"' . $ta . '","TS":"' . $ts . '"}';       
            echo $array;     
        } 
    }
?>