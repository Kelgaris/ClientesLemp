<?php

    $host = '192.168.0.109';
    $dbname = 'Usuarios';   
    $username = 'david';
    $password = 'Abc123..';
   
   $con = new mysqli($host, $username, $password, $dbname);

   if($con->connect_error){
        die("Conecxion fallida");
   }
    
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Obtener el nombre de usuario y la contraseña desde el formulario
    $username = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username = '$username' LIMIT 1";
    $resultado = $con->query($sql);
  
    if($resultado->num_rows >0){
        $row = $resultado->FETCH_ASSOC();

        if($password == $row["password"]){
            session_start();
            $_SESSION["ususario"];

            header("Location: ../clientes.html");
            exit();
        }else{
            echo("Contraseña Invalida");
        }
    }else{
        echo("Usuario Invalido");
    }
    
    $con->close();
}

?>