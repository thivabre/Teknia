const configTablas = {
    'sueldo': {
        campos: ['id_sueldo', 'sueldo_hora', 'sueldo_hora_ext', 'forma_pago'],
        accionInsertar: 'insert_sueldo',
        accionActualizar: 'update_sueldo',
        accionEliminar: 'delete_sueldo',
        accionConsutar: 'consulta_sueldo'
    },
    'precio': {
        campos: ['id_precio', 'precio_mano_obra', 'precio_rep'],
        accionInsertar: 'insert_precio',
        accionActualizar: 'update_precio',
        accionEliminar: 'delete_precio',
        accionConsutar: 'consulta_precio'
    },
    'articulo_reparar': {
        campos: ['id_articulo_reparar', 'nombre_art_rep', 'tipo_art_rep', 'fallas'],
        accionInsertar: 'insert_articulo_reparar',
        accionActualizar: 'update_articulo_reparar',
        accionEliminar: 'delete_articulo_reparar',
        accionConsutar: 'consulta_articulo_reparar'
    },
    'pago': {
        campos: ['id_pago', 'nombre_banco', 'numero_cuenta', 'comprobante'],
        accionInsertar: 'insert_pago',
        accionActualizar: 'update_pago',
        accionEliminar: 'delete_pago',
        accionConsutar: 'consulta_pago'
    },
    'garantia_servicio': {
        campos: ['id_garantia_servicio', 'tiempo_garantia', 'tipo_garantia'],
        accionInsertar: 'insert_garantia_servicio',
        accionActualizar: 'update_garantia_servicio',
        accionEliminar: 'delete_garantia_servicio',
        accionConsutar: 'consulta_garantia'
    },
    'localidad': {
        campos: ['id_localidad', 'pais', 'provincia', 'ciudad', 'barrio'],
        accionInsertar: 'insert_localidad',
        accionActualizar: 'update_localidad',
        accionEliminar: 'delete_localidad',
        accionConsutar: 'consulta_localidad'
    },
    'impuestos': {
        campos: ['id_impuestos', 'tipo_imp', 'monto_imp'],
        accionInsertar: 'insert_impuestos',
        accionActualizar: 'update_impuestos',
        accionEliminar: 'delete_impuestos',
        accionConsutar: 'consulta_impuesto'
    },
    'seguro': {
        campos: ['id_seguro', 'tipo_seg', 'nombre_aseg', 'monto_aseg'],
        accionInsertar: 'insert_seguro',
        accionActualizar: 'update_seguro',
        accionEliminar: 'delete_seguro',
        accionConsutar: 'consulta_seguro'
    },
};

let tablaActiva = '';

// ─── CARGA INICIAL ────────────────────────────────────────────────────────────
// Detecta qué tablas existen en el HTML actual y las carga automáticamente.
// Así no hace falta tocar este archivo al agregar tablas nuevas al HTML.
document.addEventListener('DOMContentLoaded', function () {
    Object.keys(configTablas).forEach(nombreTabla => {
        if (document.getElementById(nombreTabla)) {
            actualizarVistaTabla(nombreTabla);
        }
    });
});

// ─── INSERTAR DATOS ───────────────────────────────────────────────────────────
document.addEventListener('submit', async function (event) {
    event.preventDefault();
    const formulario = event.target;
    const nombreFormulario = formulario.name;

    if (!configTablas[nombreFormulario]) return;

    tablaActiva = nombreFormulario;
    const formData = new FormData(formulario);
    const conf = configTablas[tablaActiva];

    try {
        const respuesta = await fetch(`insercion.php?accion=${conf.accionInsertar}`, {
            method: 'POST',
            body: formData
        });

        if (respuesta.ok) {
            alert("¡Registro guardado!");
            actualizarVistaTabla(tablaActiva);
            formulario.reset();
        }
    } catch (error) {
        console.error("Error al enviar:", error);
    }
});

// ─── ACTUALIZAR ESTADO DE LA TABLA ───────────────────────────────────────────
// Ahora recibe la tabla como parámetro para evitar problemas con la variable global.
async function actualizarVistaTabla(nombreTabla) {
    if (!nombreTabla || !configTablas[nombreTabla]) {
        console.error("actualizarVistaTabla: tabla inválida →", nombreTabla);
        return;
    }

    const conf = configTablas[nombreTabla];
    try {
        const res = await fetch(`consulta.php?accion=${conf.accionConsutar}`);
        if (!res.ok) {
            console.error(`Error HTTP ${res.status} al consultar ${nombreTabla}`);
            return;
        }
        const datos = await res.json();
        renderizarTabla(datos, nombreTabla);
    } catch (e) {
        console.error("Error al recargar tabla:", e);
    }
}

// ─── RENDERIZAR TABLA ─────────────────────────────────────────────────────────
function renderizarTabla(listaDatos, nombreTabla) {
    const contenedor = document.getElementById(nombreTabla);
    const molde = document.getElementById(`molde-fila-${nombreTabla}`);
    if (!contenedor || !molde) return;

    contenedor.innerHTML = "";
    const camposTabla = configTablas[nombreTabla].campos;

    listaDatos.forEach(item => {
        const copia = molde.content.cloneNode(true);
        const fila = copia.querySelector('tr');
        if (!fila) return;
        const celdaAcciones = fila.querySelector('.acciones');

        fila.innerHTML = "";

        camposTabla.forEach(campo => {
            const td = document.createElement('td');
            td.classList.add(`col-${campo}`);
            td.textContent = item[campo] || '';
            fila.appendChild(td);
        });

        if (celdaAcciones) {
            fila.appendChild(celdaAcciones);
        }

        contenedor.appendChild(copia);
    });
}

// ─── EVENTOS EDITAR / ELIMINAR / GUARDAR ──────────────────────────────────────
document.addEventListener('click', async function (event) {
    const boton = event.target;

    if (!boton.classList.contains('btn-eliminar') &&
        !boton.classList.contains('btn-editar') &&
        !boton.classList.contains('btn-guardar')) return;

    const filaElemento = boton.closest('tr');
    if (!filaElemento) return;

    // Detectar a qué tabla pertenece la fila buscando el tbody padre
    const tbody = filaElemento.closest('tbody');
    if (!tbody) return;
    const nombreTabla = tbody.id;
    if (!configTablas[nombreTabla]) return;

    tablaActiva = nombreTabla;
    const configuracion = configTablas[nombreTabla];
    const nombreId = configuracion.campos[0];
    const celdaId = filaElemento.querySelector(`.col-${nombreId}`);
    if (!celdaId) return;

    const idRegistro = celdaId.textContent;

    // ELIMINAR
    if (boton.classList.contains('btn-eliminar')) {
        if (!confirm(`¿Eliminar ID: ${idRegistro}?`)) return;
        try {
            const res = await fetch(`eliminacion.php?accion=${configuracion.accionEliminar}&id=${idRegistro}`, { method: 'POST' });
            if (res.ok) filaElemento.remove();
        } catch (e) { console.error(e); }
    }

    // EDITAR
    if (boton.classList.contains('btn-editar')) {
        configuracion.campos.forEach((campo, index) => {
            if (index > 0) {
                const td = filaElemento.querySelector(`.col-${campo}`);
                if (!td) return;
                const val = td.textContent;
                td.innerHTML = `<input type="text" value="${val}" class="edit-input" data-campo="${campo}" style="width:100%">`;
            }
        });
        boton.textContent = "Guardar";
        boton.classList.replace('btn-editar', 'btn-guardar');
    }

    // GUARDAR CAMBIOS
    else if (boton.classList.contains('btn-guardar')) {
        const datos = new FormData();
        datos.append(nombreId, idRegistro);

        filaElemento.querySelectorAll('.edit-input').forEach(input => {
            datos.append(input.dataset.campo, input.value);
        });

        try {
            const res = await fetch(`actualizacion.php?accion=${configuracion.accionActualizar}`, {
                method: 'POST',
                body: datos
            });
            if (res.ok) {
                alert("Actualizado con éxito");
                actualizarVistaTabla(nombreTabla);
            }
        } catch (e) { console.error(e); }
    }
});