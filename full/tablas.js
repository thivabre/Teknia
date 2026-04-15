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
        accionConsutar: 'consulta_garantia_servicio'
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

// ─── FORULARIO ─────────────────────────────────────────────────────────────
const contenedorForm = document.querySelector('.contenedor-form-desactivado') || document.querySelector('.contenedor-form-activado');
const formularioInsert = document.querySelector('.form-insert');

// 1. ESCUCHAR CLIC EN BOTONES "AGREGAR"
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-agregar')) {
        const contenedorTabla = e.target.closest('.contenedor-tablas');
        const tablaId = contenedorTabla.querySelector('tbody').id;
        
        abrirModalInsertar(tablaId);
    }
});

// 2. FUNCIÓN PARA CONSTRUIR EL FORMULARIO SEGÚN LA TABLA
function abrirModalInsertar(nombreTabla) {
    const conf = configTablas[nombreTabla];
    if (!conf) return;

    const contenedorForm = document.querySelector('.contenedor-form-desactivado, .contenedor-form-activado');

    formularioInsert.name = nombreTabla; 
    
    const titulo = formularioInsert.querySelector('h2');
    titulo.textContent = `Insertar ${nombreTabla}`;

    // Limpiar campos y botón anteriores
    const camposViejos = formularioInsert.querySelectorAll('.campo-ingreso .campo, .btn-guardar-nuevo');
    camposViejos.forEach(el => el.remove());

    const contenedorCampos = formularioInsert.querySelector('.campo-ingreso');
    if (!contenedorCampos) return;

    conf.campos.forEach((campo, index) => {
        if (index === 0) return;

        const divCampo = document.createElement('div');
        divCampo.className = 'campo';

        const label = document.createElement('label');
        label.textContent = campo.replace(/_/g, ' ');

        const input = document.createElement('input');
        input.type = 'text';
        input.name = campo;
        input.required = true;
        input.placeholder = 'Escriba aquí...';

        divCampo.appendChild(label);
        divCampo.appendChild(input);
        contenedorCampos.appendChild(divCampo);
    });

    contenedorForm.classList.replace('contenedor-form-desactivado', 'contenedor-form-activado');
}

// CERRAR FORM
function cerrarModal() {
    const contenedorForm = document.querySelector('.contenedor-form-desactivado, .contenedor-form-activado');
    contenedorForm.classList.replace('contenedor-form-activado', 'contenedor-form-desactivado');
}

// ─── CARGA INICIAL ────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.cerrar').addEventListener('click', function() {
        cerrarModal();
    });
    Object.keys(configTablas).forEach(nombreTabla => {
        if (document.getElementById(nombreTabla)) {
            actualizarVistaTabla(nombreTabla);
        }
    });
});

// ─── INSERTAR DATOS ───────────────────────────────────────────────────────────
document.addEventListener('submit', async function (event) {
    if (event.target.classList.contains('form-insert')) {
        event.preventDefault();
        
        const nombreTabla = event.target.name;
        const conf = configTablas[nombreTabla];
        const formData = new FormData(event.target);

        try {
            formData.append('accion', conf.accionInsertar);
            const respuesta = await fetch(`insercion.php`, {
                method: 'POST',
                body: formData
            });

            if (respuesta.ok) {
                alert("¡Registro guardado!");
                actualizarVistaTabla(nombreTabla);
                cerrarModal();
            }
        } catch (error) {
            console.error("Error al insertar:", error);
        }
    }
});

// ─── ACTUALIZAR ESTADO DE LA TABLA ───────────────────────────────────────────
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
            td.textContent = item[campo] ?? '';
            fila.appendChild(td);
        });

        if (celdaAcciones) {
            fila.appendChild(celdaAcciones);
        }

        contenedor.appendChild(fila);
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

    const tbody = filaElemento.closest('tbody');
    if (!tbody) return;
    const nombreTabla = tbody.id;
    if (!configTablas[nombreTabla]) return;

    tablaActiva = nombreTabla;
    const configuracion = configTablas[nombreTabla];
    const nombreId = configuracion.campos[0];
    const celdaId = filaElemento.querySelector(`.col-${nombreId}`);
    if (!celdaId) return;

    // FIX: leer el ID desde el input si ya está en modo edición, o desde textContent si no
    const idRegistro = celdaId.querySelector('input')
        ? celdaId.querySelector('input').value
        : celdaId.textContent;

    // ELIMINAR
    if (boton.classList.contains('btn-eliminar')) {
        if (!confirm(`¿Eliminar ID: ${idRegistro}?`)) return;
        try {

            const formData = new FormData();
            formData.append(nombreId, idRegistro);

            formData.append('accion', configuracion.accionEliminar);
            const res = await fetch(`eliminacion.php`, { method: 'POST', body: formData }
);
            if (res.ok) filaElemento.remove();
        } catch (e) { console.error(e); }
    }

    // EDITAR
    else if (boton.classList.contains('btn-editar')) {
        configuracion.campos.forEach((campo) => {
            const td = filaElemento.querySelector(`.col-${campo}`);
            if (!td) return;
            const val = td.textContent;
            td.innerHTML = `<input type="text" value="${val}" class="edit-input" data-campo="${campo}" style="width:100%">`;
        });
        boton.textContent = "✔️";
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
            datos.append('accion', configuracion.accionActualizar);
            const res=await fetch(`actualizacion.php`, { method: 'POST', body: datos });
            if (res.ok) {
                alert("Actualizado con éxito");
                actualizarVistaTabla(nombreTabla);
            }
        } catch (e) { console.error(e); }
    }
});
