<?php
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            echo $id;
            
            $host = '192.168.0.109';
            $dbname = 'Usuarios';
            $username = 'david';
            $password = 'Abc123..';
        
            $con = new mysqli($host, $username, $password, $dbname);
        
            if ($con->connect_error) {
                die("Conexión fallida: " . $con->connect_error);
            }
        
           
            $sql = "DELETE FROM clientes WHERE id = ?";
            $stmt = $con->prepare($sql);
            // "i" significa entero para el ID
            $stmt->bind_param("i", $id);  
            $stmt->execute();
        
            
            if ($stmt->affected_rows > 0) {
                echo "Cliente eliminado correctamente.";
            } else {
                echo "Error al eliminar el cliente.";
            }
        
            $stmt->close();
            $con->close();

        } else {
            echo "ID no proporcionado.";
        }
    }
?>