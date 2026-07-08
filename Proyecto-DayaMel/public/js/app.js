document.addEventListener('DOMContentLoaded', () => {
    // Funcionamiento del carrito
    
    let carrito = JSON.parse(localStorage.getItem('carrito_dayamel')) || [];

    const contadorCarrito = document.getElementById('contador-carrito');
    const itemsCarrito = document.getElementById('items-carrito');
    const precioTotal = document.getElementById('precio-total');
    const botonIrAPagar = document.getElementById('ir-a-pagar');
    const montoCheckout = document.getElementById('monto-checkout');
    
    const modalCarrito = document.getElementById('modal-carrito');
    const modalPago = document.getElementById('modal-pago');
    
    const btnVerCarrito = document.getElementById('ver-carrito');
    const btnCerrarCarrito = document.getElementById('cerrar-carrito');
    const btnCerrarPago = document.getElementById('cerrar-pago');
    const formPago = document.getElementById('formulario-pago');

    actualizarInterfazCarrito();

    // Agregar Productos al carrito
    const botonesAgregar = document.querySelectorAll('.boton-agregar');
    botonesAgregar.forEach(boton => {
        boton.addEventListener('click', (e) => {
            const tarjeta = e.target.closest('.tarjeta-producto');
            const id = tarjeta.dataset.id;
            const nombre = tarjeta.dataset.nombre;
            const precio = parseFloat(tarjeta.dataset.precio);

            agregarAlCarrito(id, nombre, precio);
        });
    });
// Buscar un arreglo
    function agregarAlCarrito(id, nombre, precio) {
        const existe = carrito.find(item => item.id === id);

        if (existe) {
            existe.cantidad++;
        } else {
            carrito.push({ id, nombre, precio, cantidad: 1 });
        }

        actualizarInterfazCarrito();
        
        if (btnVerCarrito) {
            btnVerCarrito.style.transform = 'scale(1.1)';
            setTimeout(() => btnVerCarrito.style.transform = 'scale(1)', 200);
        }
    }

    function actualizarInterfazCarrito() {
        localStorage.setItem('carrito_dayamel', JSON.stringify(carrito));

        if (!itemsCarrito) return;

        itemsCarrito.innerHTML = '';

        if (carrito.length === 0) {
            itemsCarrito.innerHTML = '<p class="carrito-vacio">Tu carrito está vacío.</p>';
            if (botonIrAPagar) botonIrAPagar.disabled = true;
            if (contadorCarrito) contadorCarrito.textContent = '0';
            if (precioTotal) precioTotal.textContent = '0.00';
            return;
        }

        if (botonIrAPagar) botonIrAPagar.disabled = false;
        let total = 0;
        let totalArticulos = 0;

        
        carrito.forEach(item => {
            total += item.precio * item.cantidad;
            totalArticulos += item.cantidad;

            const divItem = document.createElement('div');
            divItem.classList.add('item-en-carrito');
            divItem.innerHTML = `
                <div>
                    <strong>${item.nombre}</strong><br>
                    <small>$${item.precio.toFixed(2)} x ${item.cantidad}</small>
                </div>
                <div>
                    <span>$${(item.precio * item.cantidad).toFixed(2)}</span>
                    <button class="eliminar-item" data-id="${item.id}"> ✕ </button>
                </div>
            `;
            itemsCarrito.appendChild(divItem);
        });

        if (contadorCarrito) contadorCarrito.textContent = totalArticulos;
        if (precioTotal) precioTotal.textContent = total.toFixed(2);
        if (montoCheckout) montoCheckout.textContent = total.toFixed(2);

        //Eliminar un Producto
        const botonesEliminar = itemsCarrito.querySelectorAll('.eliminar-item');
        botonesEliminar.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const idEliminar = e.target.dataset.id;
                carrito = carrito.filter(item => item.id !== idEliminar);
                actualizarInterfazCarrito();
            });
        });
    }

    //Pagos
    if (btnVerCarrito) {
        btnVerCarrito.addEventListener('click', (e) => {
            e.preventDefault();
            if (modalCarrito) modalCarrito.style.display = 'block';
        });
    }

    if (btnCerrarCarrito) {
        btnCerrarCarrito.addEventListener('click', () => {
            if (modalCarrito) modalCarrito.style.display = 'none';
        });
    }

    if (botonIrAPagar) {
        botonIrAPagar.addEventListener('click', () => {
            if (modalCarrito) modalCarrito.style.display = 'none';
            if (modalPago) modalPago.style.display = 'block';
        });
    }

    if (btnCerrarPago) {
        btnCerrarPago.addEventListener('click', () => {
            if (modalPago) modalPago.style.display = 'none';
        });
    }

    window.addEventListener('click', (e) => {
        if (e.target === modalCarrito) modalCarrito.style.display = 'none';
        if (e.target === modalPago) modalPago.style.display = 'none';
    });

    if (formPago) {
        formPago.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Procesando pago con los servidores de la tarjeta...\n\n¡Transacción Exitosa! Gracias por tu compra en DayaMel-Skincare.');
            carrito = [];
            actualizarInterfazCarrito();
            formPago.reset();
            if (modalPago) modalPago.style.display = 'none';
        });
    }

    //Validar Formulario
    const formContacto = document.getElementById('formulario-contacto');
    const datosContacto = {
        nombre: '',
        correo: '',
        mensaje: ''
    };

    const inputNombre = document.getElementById('nombre');
    const inputCorreo = document.getElementById('correo');
    const inputMensaje = document.getElementById('mensaje');

    if(inputNombre && inputCorreo && inputMensaje) {
        inputNombre.addEventListener('input', leerTexto);
        inputCorreo.addEventListener('input', leerTexto);
        inputMensaje.addEventListener('input', leerTexto);
    }

    function leerTexto(e) {
        datosContacto[e.target.id] = e.target.value;
    }

    if (formContacto) {
        formContacto.addEventListener('submit', function (evento) {
            evento.preventDefault();

            const { nombre, correo, mensaje } = datosContacto;

            if (nombre.trim() === '' || correo.trim() === '' || mensaje.trim() === '') {
                mostrarAlerta('Todos los campos son obligatorios', 'error');
                return; // Corta la ejecución como indica el apunte
            }

            mostrarAlerta('¡Formulario enviado correctamente!', 'correcto');
            formContacto.reset();
            datosContacto.nombre = '';
            datosContacto.correo = '';
            datosContacto.mensaje = '';
        });

        function mostrarAlerta(mensaje, tipoClase) {
            const alertaPrevia = formContacto.querySelector('.error, .correcto');
            if (alertaPrevia) {
                alertaPrevia.remove();
            }

            const alerta = document.createElement("P");
            alerta.textContent = mensaje;
            alerta.classList.add(tipoClase);
            
            formContacto.appendChild(alerta);

            setTimeout(() => {
                alerta.remove();
            }, 4000);
        }
    }
});