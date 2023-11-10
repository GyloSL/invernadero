<?php
    //Se cargan los usuarios en el modulo de usuarios
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
        $array = "[";
        if(!$con){
             echo "falló la conexión a la base de datos";
        } else {
            $query = "SELECT username, pass, rol, estatus FROM usuarios WHERE id_invernadero='1'";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                $array = $array . '{"username":"' . $row["username"] . '","estatus":' . $row["estatus"] . '},';
            }  
            $array = substr($array, 0, -1) . "]";
            echo $array;
        } 
    }
?>