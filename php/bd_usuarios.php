<?php 
    //Funcion para conectar a la base de datos
    function conectar(){
        $server = "127.0.0.1";
        $database = "invernadero";
        $user = "sa";
        $pas = "Admin_123";
        $con = mysqli_connect($server, $user, $pas, $database);
    
        if(!$con){
            echo "falló la conexión a la base de datos";
        }
        
        return $con;
    }
    
    //Funcion para crear un nuevo usuario
    function crear($username, $password, $rol, $invernadero) {
        $con = conectar();
        $query = "INSERT INTO usuarios (username, pass, rol, estatus, id_invernadero) VALUES ('$username', '$password', '$rol', 1, $invernadero);";
        $result = mysqli_query($con, $query);
        mysqli_close($con);
    }

    //Funcion para iniciar sesión
    //retorna el rol en caso de que se encuentre el usuario ingresado
    //y si no retorna un -1 indicando que no se encontró el usuario
    //con ese usuario y contraseña
    function login($username, $password){
        $con = conectar();
        $query = "SELECT * FROM usuarios WHERE username='$username' AND pass='$password' AND estatus=1";
        $result = mysqli_query($con, $query);

        if ($row = mysqli_fetch_array($result)) {
            if ($row["estatus"] == "1"){
                mysqli_close($con);
                return $row["rol"] ;
            } 
            mysqli_close($con);
            return "-1";
        } else {
            mysqli_close($con);
            return "-1";
        }
    }

    //Funcion para habilitar un usuario
    function habilitar($usuario){
        $con = conectar();
        $query = "UPDATE usuarios SET estatus=1 where username='$usuario'";
        $result = mysqli_query($con, $query);
        mysqli_close($con);
    }

    //Funcion para deshabilitar un usuario
    function inhabilitar($usuario){
        $con = conectar();
        $query = "UPDATE usuarios SET estatus=0 where username='$usuario'";
        $result = mysqli_query($con, $query);
        mysqli_close($con);
    }

    //Funcion para editar un usuario
    function editar($username,$editUsername, $pass, $rol){
        $con = conectar();
        $query = "SELECT estatus, id_invernadero FROM usuarios WHERE username='$username'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        $estatus = $row["estatus"];
        $invernadero = $row["id_invernadero"];
        $query = "UPDATE usuarios SET username='$editUsername', pass='$pass', rol='$rol', estatus=$estatus, id_invernadero='$invernadero' WHERE username='$username'";
        $result = mysqli_query($con, $query);
        mysqli_close($con);
    }
?>