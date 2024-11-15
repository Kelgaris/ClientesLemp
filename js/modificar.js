"use strict";

document.addEventListener("DOMContentLoaded", function () {
    const cliente = JSON.parse(localStorage.getItem("clienteParaModificar"));

    if (cliente) {
        document.getElementById('nombre').value = cliente.nombre;
        document.getElementById('apellido1').value = cliente.apellido1;
        document.getElementById('apellido2').value = cliente.apellido2;
        document.getElementById('direccion').value = cliente.direccion;
        document.getElementById('correo').value = cliente.correo;
        document.getElementById('puesto').value = cliente.puesto;


    } else {
        alert("No se encontraron datos del cliente para modificar.");
    }
});

function guardarCambios() {
    const cliente = JSON.parse(localStorage.getItem("clienteParaModificar"));
    const data = {
        id: cliente.id,
        nombre: document.getElementById('nombre').value,
        apellido1: document.getElementById('apellido1').value,
        apellido2: document.getElementById('apellido2').value,
        direccion: document.getElementById('direccion').value,
        correo: document.getElementById('correo').value,
        puesto: document.getElementById('puesto').value
    };

    fetch('./php/modificarCliente.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.text())
    .then(data => {
        alert("Usuario Modificado Correctamente.")
        window.location.href = './clientes.html';
    })
    .catch(error => console.error('Error al guardar cambios:', error));
}