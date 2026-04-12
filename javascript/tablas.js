/**
 * 1. EL "DICCIONARIO" DE CONFIGURACIÓN
 * Aquí defines cómo se llama la tabla, qué columnas tiene y qué acciones ejecuta en el PHP.
 */
const configTablas = {
    'sueldo': {
        campos: ['id_sueldo', 'sueldo_hora', 'sueldo_hora_ext', 'forma_pag'],
        accionInsertar: 'insertar_sueldo',
        accionActualizar: 'actualizar_sueldo',
        accionEliminar: 'eliminar_sueldo'
    },
    'precio': {
        campos: ['id_precio', 'precio_mano_obra', 'precio_rep'],
        accionInsertar: 'insertar_precio',
        accionActualizar: 'actualizar_precio',
        accionEliminar: 'eliminar_precio'
    },
    'articulo_reparar': {
        campos: ['id_articulo_reparar', 'nombre_art_rep', 'tipo_art_rep', 'fallas'],
        accionInsertar: 'insertar_articulo_reparar',
        accionActualizar: 'actualizar_articulo_reparar',
        accionEliminar: 'eliminar_articulo_reparar'
    },
    'pago': {
        campos: ['id_pago', 'nombre_banco', 'numero_cuenta', 'comprobante'],
        accionInsertar: 'insertar_pago',
        accionActualizar: 'actualizar_pago',
        accionEliminar: 'eliminar_pago'
    },
    'garantia_servicio': {
        campos: ['id_garantia_servicio', 'tiempo_garantia', 'tipo_garantia',],
        accionInsertar: 'insertar_garantia_servicio',
        accionActualizar: 'actualizar_garantia_servicio',
        accionEliminar: 'eliminar_garantia_servicio'
    },
    'localidad': {
        campos: ['id_localidad', 'pais', 'provincia', 'ciudad', 'barrio'],
        accionInsertar: 'insertar_localidad',
        accionActualizar: 'actualizar_localidad',
        accionEliminar: 'eliminar_localidad'
    },
};

// Variable para recordar qué tabla estamos viendo actualmente
let tablaActiva = '';

/**
 * 2. DETECCIÓN DEL SUBMIT (INSERTAR DATOS)
 */
document.addEventListener('submit', async function (event) {
    event.preventDefault();

    const formulario = event.target;
    const nombreFormulario = formulario.name;

    // Verificamos si la tabla existe en nuestro diccionario
    if (!configTablas[nombreFormulario]) {
        console.error(`El formulario "${nombreFormulario}" no está en el diccionario.`);
        return;
    }

    // Actualizamos la tabla activa
    tablaActiva = nombreFormulario;
    
    const formData = new FormData(formulario);
    const accionInsertar = configTablas[tablaActiva].accionInsertar;

    try {
        // Petición a api.php
        const respuesta = await fetch(`insercion.php?accion=${accionInsertar}`, {
            method: 'POST',
            body: formData
        });

        if (respuesta.ok) {
            const nuevosDatos = await respuesta.json(); // Esperamos que PHP devuelva la tabla actualizada
            alert("¡Registro guardado con éxito!");
            
            renderizarTabla(nuevosDatos, tablaActiva);
            formulario.reset();
        } else {
            throw new Error("Error en el servidor al guardar.");
        }
    } catch (error) {
        console.error("Hubo un error al enviar:", error);
    }
});

/**
 * 3. RENDERIZAR TABLA CON EL TEMPLATE HTML
 */
function renderizarTabla(listaDatos, nombreTabla) {
    const contenedor = document.getElementById('tabla-destino');
    const molde = document.getElementById('molde-fila');
    
    if (!contenedor || !molde) return;

    contenedor.innerHTML = ""; // Limpiamos la tabla
    const camposTabla = configTablas[nombreTabla].campos; // Sacamos los campos del diccionario

    listaDatos.forEach(item => {
        const copia = molde.content.cloneNode(true);
        const fila = copia.querySelector('tr');
        
        // Guardamos las acciones (botones) para ponerlos al final
        const celdaAcciones = fila.querySelector('.acciones');
        fila.innerHTML = ""; 

        // Creamos las celdas dinámicamente según el diccionario
        camposTabla.forEach(campo => {
            const td = document.createElement('td');
            td.classList.add(`col-${campo}`);
            td.textContent = item[campo] || '';
            fila.appendChild(td);
        });

        // Re-insertamos los botones
        fila.appendChild(celdaAcciones);
        contenedor.appendChild(copia);
    });
}

/**
 * 4. DELEGACIÓN DE EVENTOS PARA ELIMINAR Y EDITAR
 */
document.getElementById('tabla-destino').addEventListener('click', async function(event) {
    const boton = event.target;
    const filaElemento = boton.closest('tr');
    
    if (!filaElemento || !tablaActiva) return;

    // Asumimos que el ID siempre está en la clase .col-id
    const idRegistro = filaElemento.querySelector('.col-id').textContent;
    const configuracion = configTablas[tablaActiva];

    // --- ACCIÓN: ELIMINAR ---
    if (boton.classList.contains('btn-eliminar')) {
        if (!confirm(`¿Eliminar el registro ID: ${idRegistro}?`)) return;

        try {
            const respuesta = await fetch(`eliminacion.php?accion=${configuracion.accionEliminar}&id=${idRegistro}`, {
                method: 'POST'
            });

            if (respuesta.ok) {
                filaElemento.remove(); // Borramos la fila de la pantalla
            }
        } catch (error) {
            console.error("Error al eliminar:", error);
        }
    }

    // --- ACCIÓN: EDITAR ---
    if (boton.classList.contains('btn-editar')) {
        const campos = configuracion.campos;
        
        // Convertimos las celdas en inputs (excepto el ID)
        campos.forEach(campo => {
            if (campo !== configTablas[tablaActiva].campos[0]) {
                const td = filaElemento.querySelector(`.col-${campo}`);
                const valorActual = td.textContent;
                td.innerHTML = `<input type="text" value="${valorActual}" class="edit-input" data-campo="${campo}">`;
            }
        });

        // Cambiamos el botón
        boton.textContent = "Guardar";
        boton.classList.replace('btn-editar', 'btn-guardar');
    }

    // --- ACCIÓN: GUARDAR CAMBIOS ---
    if (boton.classList.contains('btn-guardar')) {
        const datosModificados = new FormData();
        datosModificados.append('id', idRegistro);

        // Recolectamos los valores de los inputs nuevos
        const inputs = filaElemento.querySelectorAll('.edit-input');
        inputs.forEach(input => {
            const nombreCampo = input.getAttribute('data-campo');
            datosModificados.append(nombreCampo, input.value);
        });

        try {
            const respuesta = await fetch(`actualizacion.php?accion=${configuracion.accionActualizar}`, {
                method: 'POST',
                body: datosModificados
            });

            if (respuesta.ok) {
                const nuevosDatos = await respuesta.json();
                renderizarTabla(nuevosDatos, tablaActiva); // Dibujamos la tabla limpia
                alert("Cambios aplicados.");
            }
        } catch (error) {
            console.error("Error al actualizar:", error);
        }
    }
});
