"use strict";


function imprimirCartas(){
    fetch('./php/obtenerClientes.php')
            .then(response => response.json())
            .then(data => {
                let contenedor = document.getElementById('containerTarjetas');
                contenedor.innerHTML = "";

                data.forEach(cliente => {
                    let tarjeta = document.createElement('div');
                    tarjeta.classList.add('tarjetaCliente');
                    tarjeta.classList.add(`${cliente.id}`);

                    tarjeta.innerHTML = `
                        <img src="${cliente.imagen}" alt="cliente">
                        <div class="datos">
                            <div class="datosPersonales">
                                <span class="nombre">${cliente.nombre}</span>
                                <span class="apellido1">${cliente.apellido1}</span>
                                <span class="apellido2">${cliente.apellido2}</span>
                            </div>
                            <span class="direccion">${cliente.direccion}</span>
                            <span class="correo">${cliente.correo}</span>
                        </div>
                        <div class="roleContainer">
                            <span class="role">${cliente.puesto}</span>
                        </div>
                        <div class="botones">
                            <button class="modificar" onclick="irAModificar(${encodeURIComponent(JSON.stringify(cliente))})"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button class="eliminar" type="submit"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    `;


                    tarjeta.querySelector('.modificar').addEventListener('click', () => {
                        irAModificar(cliente);
                    });

                    contenedor.appendChild(tarjeta);
                });

                eliminarCliente();

            })
            .catch(error => console.error('Error al obtener los datos:', error));
}



function eliminarCliente(){
    document.querySelectorAll(".eliminar").forEach(button =>{
        button.addEventListener("click", function() {
           
            const tarjeta = button.closest(".tarjetaCliente");
            
            
            const clienteId = tarjeta.classList[1]; 
            
            console.log(clienteId);
            
           
            if (clienteId) {
               
                fetch('./php/eliminarCliente.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${clienteId}` 
                })
                .then(response => response.text())
                .then(data => {
                        
                        tarjeta.remove();
                    
                })
                .catch(error => {
                    console.error('Error al eliminar cliente:', error);
                    alert("Hubo un problema al procesar la solicitud.");
                });
            } else {
                alert("No se ha encontrado el ID del cliente.");
            }
        });
    });    
}


function irAModificar(cliente) {
    // Guardar los datos del cliente en localStorage
    localStorage.setItem("clienteParaModificar", JSON.stringify(cliente));
    // Redirigir al formulario de modificación
    window.location.href = './modificar.html';
}


imprimirCartas();