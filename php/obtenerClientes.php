<?php

    $host = '192.168.0.109';
    $dbname = 'Usuarios';
    $username = 'david';
    $password = 'Abc123..';


    $conn = new mysqli($host, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    
    $sql = "SELECT id, nombre, apellido1, apellido2, direccion, correo, puesto, imagen FROM clientes";
    $result = $conn->query($sql);
    
    
    $clientes = array();
    
    if ($result->num_rows > 0) {
    
        while($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }
    }
    
    
    echo json_encode($clientes);
    
    
    $conn->close();

?>