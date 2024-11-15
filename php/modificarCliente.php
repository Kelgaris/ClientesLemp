<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    $id = $data['id'];
    $nombre = $data['nombre'];
    $apellido1 = $data['apellido1'];
    $apellido2 = $data['apellido2'];
    $direccion = $data['direccion'];
    $correo = $data['correo'];
    $puesto = $data['puesto'];

    $con = new mysqli('192.168.0.109', 'david', 'Abc123..', 'Usuarios');

    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }

    $stmt = $con->prepare("UPDATE clientes SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, correo = ?, puesto = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $nombre, $apellido1, $apellido2, $direccion, $correo, $puesto, $id);

    if ($stmt->execute()) {
        echo "Cliente modificado correctamente.";
    } else {
        echo "Error al modificar el cliente.";
    }

    $stmt->close();
    $con->close();

    header("Location: ../clientes.html");
    exit();
}

?>