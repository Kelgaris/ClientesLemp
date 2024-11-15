<?php

    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $puesto = $_POST['puesto'];
    $imagen = "./src/cliente.png";



    $cadenaCorreo = "/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/";

    if(!empty($nombre) && !empty($apellido1) && !empty($apellido2) && !empty($direccion) && !empty($correo) && !empty($puesto)){
        if(trim($nombre) && trim($apellido1) && trim($apellido2) && trim($correo) && trim($puesto)){
            if(preg_match($cadenaCorreo, $correo)){
                
                //Procedemos a enviarlo a la base de datos.

                $host = 'localhost';
                $dbname = 'Usuarios';
                $username = 'root';
                $password = '';

                $con = new mysqli($host, $username, $password, $dbname);

                if($con->connect_error){
                    die("Conecxion fallida" . $con->connect_error);
                }

                $sql = $con->prepare("INSERT INTO clientes(nombre,apellido1, apellido2, direccion, correo, puesto, imagen) VALUES (?,?,?,?,?,?,?)");

                $sql ->bind_param("sssssss",$nombre, $apellido1, $apellido2, $direccion, $correo, $puesto, $imagen);

                if($sql->execute()){
                    echo "Datos guardados correctamente";
                }else{
                    echo "Error al guardar datos". $sql->error;
                }

                $sql->close();
                $con->close();

                header("Location: ../clientes.html");
                exit();

            }else{
                echo "Correo no valido";
            }
        }else{
            echo("El contenido no puede tener espacios en blanco.");
        }
    }else{
        echo "Ninguno de los campos puede estar vacios";
    }



?>