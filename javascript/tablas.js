const configTablas = {
    'sueldo': {
        campos: ['id_sueldo', 'sueldo_hora', 'sueldo_hora_ext', 'forma_pago'],
        accionInsertar:  'insert_sueldo',
        accionActualizar:'update_sueldo',
        accionEliminar:  'delete_sueldo',
        accionConsutar:  'consulta_sueldo'
    },
    'precio': {
        campos: ['id_precio', 'precio_mano_obra', 'precio_rep'],
        accionInsertar:  'insert_precio',
        accionActualizar:'update_precio',
        accionEliminar:  'delete_precio',
        accionConsutar:  'consulta_precio'
    },
    'articulo_reparar': {
        campos: ['id_articulo_reparar', 'nombre_art_rep', 'tipo_art_rep', 'fallas'],
        accionInsertar:  'insert_articulo_reparar',
        accionActualizar:'update_articulo_reparar',
        accionEliminar:  'delete_articulo_reparar',
        accionConsutar:  'consulta_articulo_reparar'
    },
    'pago': {
        // Sin acciones CRUD directas: se gestiona desde servicios-facturas
        campos: ['id_pago', 'nombre_banco', 'numero_cuenta', 'comprobante', 'monto', 'fecha_factura'],
        accionInsertar:  '',
        accionActualizar:'',
        accionEliminar:  '',
        accionConsutar:  'consulta_pagos_detalle'
    },
    'garantia_servicio': {
        campos: ['id_garantia_servicio', 'tiempo_garantia', 'tipo_garantia'],
        accionInsertar:  'insert_garantia_servicio',
        accionActualizar:'update_garantia_servicio',
        accionEliminar:  'delete_garantia_servicio',
        accionConsutar:  'consulta_garantia_servicio'
    },
    'localidad': {
        campos: ['id_localidad', 'pais', 'provincia', 'ciudad', 'barrio'],
        accionInsertar:  'insert_localidad',
        accionActualizar:'update_localidad',
        accionEliminar:  'delete_localidad',
        accionConsutar:  'consulta_localidad'
    },
    'impuestos': {
        campos: ['id_impuestos', 'tipo_imp', 'monto_imp'],
        accionInsertar:  'insert_impuestos',
        accionActualizar:'update_impuestos',
        accionEliminar:  'delete_impuestos',
        accionConsutar:  'consulta_impuesto'
    },
    'seguro': {
        campos: ['id_seguro', 'tipo_seg', 'nombre_aseg', 'monto_aseg'],
        accionInsertar:  'insert_seguro',
        accionActualizar:'update_seguro',
        accionEliminar:  'delete_seguro',
        accionConsutar:  'consulta_seguro'
    },
    'direccion_empleado': {
        campos: ['id_direccion_empleado', 'calle', 'numero', 'ciudad', 'provincia', 'codigo_postal', 'id_empleado'],
        accionInsertar:  'insert_direccion_empleado',
        accionActualizar:'update_direccion_empleado',
        accionEliminar:  'delete_direccion_empleado',
        accionConsutar:  'consulta_direccion_empleado'
    },
    'direccion_cliente': {
        campos: ['id_direccion_cliente', 'calle', 'numero', 'ciudad', 'provincia', 'codigo_postal', 'id_cliente'],
        accionInsertar:  'insert_direccion_cliente',
        accionActualizar:'update_direccion_cliente',
        accionEliminar:  'delete_direccion_cliente',
        accionConsutar:  'consulta_direccion_cliente'
    },
    'direccion_sucursal': {
        campos: ['id_direccion_sucursal', 'calle', 'numero', 'ciudad', 'provincia', 'codigo_postal', 'id_sucursal'],
        accionInsertar:  'insert_direccion_sucursal',
        accionActualizar:'update_direccion_sucursal',
        accionEliminar:  'delete_direccion_sucursal',
        accionConsutar:  'consulta_direccion_sucursal'
    },
    'direccion_proveedor': {
        campos: ['id_direccion_proveedor', 'calle', 'numero', 'ciudad', 'provincia', 'codigo_postal', 'id_proveedor'],
        accionInsertar:  'insert_direccion_proveedor',
        accionActualizar:'update_direccion_proveedor',
        accionEliminar:  'delete_direccion_proveedor',
        accionConsutar:  'consulta_direccion_proveedor'
    },
    'inventario_productos': {
        // Solo lectura: el inventario se gestiona desde inventario-productos
        campos: ['id_inv_productos', 'nombre_producto', 'tipo_producto', 'fallas', 'cantidad_prod'],
        accionInsertar:  '',
        accionActualizar:'',
        accionEliminar:  '',
        accionConsutar:  'consulta_inv_productos_detalle'
    },
    'contrato_empleado': {
        campos: ['id_contrato_emple', 'fecha_cont', 'turno', 'sueldo_hora', 'sueldo_hora_ext', 'forma_pago'],
        camposAutoFecha: ['fecha_cont'], // fecha_cont la pone la DB
        accionInsertar:  'insert_contrato_empleado',
        accionActualizar:'update_contrato_empleado',
        accionEliminar:  'delete_contrato_empleado',
        accionConsutar:  'consulta_contratos_detalle'
    },
    'repuestos': {
        campos: ['id_repuesto', 'nombre_rep', 'tipo_rep', 'precio_unidad', 'precio_mano_obra'],
        accionInsertar:  'insert_repuestos',
        accionActualizar:'update_repuestos',
        accionEliminar:  'delete_repuestos',
        accionConsutar:  'consulta_repuestos_detalle'
    },
    'factura_servicio': {
        campos: ['id_factura', 'fecha', 'total', 'id_cliente', 'id_orden_servicio'],
        accionInsertar:  'insert_factura_servicio',
        accionActualizar:'update_factura_servicio',
        accionEliminar:  'delete_factura_servicio',
        accionConsutar:  'consulta_factura_servicio'
    },
    'proveedor': {
        campos: ['id_proveedor', 'nombre', 'telefono', 'email'],
        accionInsertar:  'insert_proveedor',
        accionActualizar:'update_proveedor',
        accionEliminar:  'delete_proveedor',
        accionConsutar:  'consulta_proveedor'
    },
    'inventario_repuestos': {
        campos: ['id_inventario_repuesto', 'id_repuesto', 'stock', 'id_sucursal'],
        accionInsertar:  'insert_inventario_repuestos',
        accionActualizar:'update_inventario_repuestos',
        accionEliminar:  'delete_inventario_repuestos',
        accionConsutar:  'consulta_inventario_repuestos'
    },
    'presupuestos': {
        campos: ['id_presupuesto', 'fecha', 'total', 'id_cliente'],
        accionInsertar:  'insert_presupuestos',
        accionActualizar:'update_presupuestos',
        accionEliminar:  'delete_presupuestos',
        accionConsutar:  'consulta_presupuestos'
    },
    'sucursales': {
        campos: ['id_sucursal', 'nombre', 'telefono'],
        accionInsertar:  'insert_sucursales',
        accionActualizar:'update_sucursales',
        accionEliminar:  'delete_sucursales',
        accionConsutar:  'consulta_sucursales'
    },
    'empleado': {
        campos: ['id_empleado', 'nombre', 'apellido', 'dni', 'telefono', 'email'],
        accionInsertar:  'insert_empleado',
        accionActualizar:'update_empleado',
        accionEliminar:  'delete_empleado',
        accionConsutar:  'consulta_empleado'
    },
    'sucursales_proveedor': {
        campos: ['id_sucursal', 'id_proveedor'],
        accionInsertar:  'insert_sucursales_proveedor',
        accionActualizar:'update_sucursales_proveedor',
        accionEliminar:  'delete_sucursales_proveedor',
        accionConsutar:  'consulta_sucursales_proveedor'
    },
    'orden_servicio': {
        campos: ['id_orden_servicio', 'fecha', 'estado', 'id_cliente', 'id_empleado'],
        accionInsertar:  'insert_orden_servicio',
        accionActualizar:'update_orden_servicio',
        accionEliminar:  'delete_orden_servicio',
        accionConsutar:  'consulta_orden_servicio'
    },
    'cliente': {
        campos: ['id_cliente', 'nombre', 'apellido', 'telefono', 'email'],
        accionInsertar:  'insert_cliente',
        accionActualizar:'update_cliente',
        accionEliminar:  'delete_cliente',
        accionConsutar:  'consulta_cliente'
    },
    'orden_entrega': {
        campos: ['id_orden_entrega', 'fecha_entrega', 'estado', 'id_orden_servicio'],
        accionInsertar:  'insert_orden_entrega',
        accionActualizar:'update_orden_entrega',
        accionEliminar:  'delete_orden_entrega',
        accionConsutar:  'consulta_orden_entrega'
    },
    'ubicacion_sucursales': {
        // Solo lectura: join entre sucursales y direcciones
        campos: ['id_sucursal', 'pais', 'provincia', 'ciudad', 'barrio', 'cod_postal_suc', 'direccion'],
        accionInsertar:  '',
        accionActualizar:'',
        accionEliminar:  '',
        accionConsutar:  'consulta_ubicacion_sucursales'
    },
    'historial_orden_servicio': {
        // Solo lectura: vista de historial completo con joins
        campos: ['id_orden_servicio', 'nombre_art_rep', 'tipo_art_rep', 'fallas',
                 'fecha_orden', 'fecha_entrega', 'id_sucursal', 'fecha_factura'],
        accionInsertar:  '',
        accionActualizar:'',
        accionEliminar:  '',
        accionConsutar:  'consulta_historial_ordenes'
    }
};

/** Tabla actualmente en modo edición (usado por los eventos de guardar). */
let tablaActiva = '';

// ─── ROL Y SESIÓN ─────────────────────────────────────────────────────────

/**
Consulta get_rol.php para verificar si hay una sesión activa.
Si no hay sesión, redirige automáticamente al login.
 */
async function verificarSesion() {
    try {
        const res   = await fetch('get_rol.php');
        const datos = await res.json();

        if (datos.estado !== 'ok') {
            window.location.href = 'inicio_sesion.html';
            return null;
        }
        return datos;

    } catch (e) {
        console.error('Error al verificar sesión:', e);
        window.location.href = 'inicio_sesion.html';
        return null;
    }
}

/**
Muestra los elementos con [data-rol] que incluyen el rol actual
y oculta todos los demás.
 */
function aplicarRol(rol) {
    // Ocultar todos los elementos con restricción de rol
    document.querySelectorAll('[data-rol]').forEach(el => {
        el.style.display = 'none';
    });
    // Mostrar solo los que incluyen el rol actual en su lista
    document.querySelectorAll(`[data-rol*="${rol}"]`).forEach(el => {
        el.style.display = '';
    });
}

/**
Actualiza el área de autenticación del navbar:
 */
function actualizarNavAuth(sesion) {
    const navAuth = document.getElementById('nav-auth-area');
    if (!navAuth) return;

    if (sesion) {
        // Etiqueta amigable para mostrar el rol en el navbar
        const rolLabel = {
            'cliente':       'Cliente',
            'empleado':      'Empleado',
            'jefe_sucursal': 'Jefe de sucursal',
            'jefe_general':  'Jefe general'
        }[sesion.rol] || sesion.rol;

        navAuth.innerHTML = `
            <span style="
                color: rgba(255,255,255,0.6);
                font-size: 12px;
                padding: 0 10px;
                line-height: 1.3;
                display: flex;
                flex-direction: column;
                align-items: flex-end;
            ">
                <span style="color:#fff;font-weight:600">${sesion.nombre}</span>
                <span style="font-size:10px;opacity:.7">${rolLabel}</span>
            </span>
            <button id="btn-logout" class="btn-sesion" style="
                cursor: pointer; border: none;
                height: 34px !important; padding: 0 14px !important;
                border-radius: 15px !important; font-size: 12px !important;
                font-weight: 600 !important;
                background: rgba(255,255,255,0.08) !important;
                color: rgba(255,255,255,0.65) !important;
            ">
                Cerrar sesión
            </button>
        `;

        // Botón de logout: llama a login_proceso.php con accion=logout
        document.getElementById('btn-logout').addEventListener('click', async function () {
            const fd = new FormData();
            fd.append('accion', 'logout');
            await fetch('login_proceso.php', { method: 'POST', body: fd });
            window.location.href = 'inicio_sesion.html';
        });
    }
}

// ─── FORMULARIO DE INSERCIÓN ──────────────────────────────────────────────

/**
Referencia al formulario de inserción presente en páginas con tablas CRUD.
 */
const formularioInsert = document.querySelector('.form-insert');

/**
Listener de clic global para los botones "Agregar" (btn-agregar).
Detecta en qué tabla está el botón y abre el modal de inserción correspondiente.
 */
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-agregar')) {
        const contenedorTabla = e.target.closest('.contenedor-tablas');
        if (!contenedorTabla) return;
        const tbody = contenedorTabla.querySelector('tbody');
        if (!tbody) return;
        abrirModalInsertar(tbody.id);
    }
});

/**
Construye dinámicamente el formulario de inserción según la configuración
de la tabla indicada y lo muestra deslizando el panel desde abajo.
 */
function abrirModalInsertar(nombreTabla) {
    const conf = configTablas[nombreTabla];
    if (!conf) return;

    const contenedorForm = document.querySelector('.contenedor-form-desactivado, .contenedor-form-activado');
    if (!contenedorForm || !formularioInsert) return;

    // Asociar el formulario con la tabla actual
    formularioInsert.name = nombreTabla;

    // Actualizar el título del formulario
    const titulo = formularioInsert.querySelector('h2');
    if (titulo) titulo.textContent = `Insertar ${nombreTabla}`;

    // Eliminar campos anteriores para reconstruirlos
    formularioInsert
        .querySelectorAll('.campo-ingreso .campo, .btn-guardar-nuevo')
        .forEach(el => el.remove());

    const contenedorCampos = formularioInsert.querySelector('.campo-ingreso');
    if (!contenedorCampos) return;

    const autoFecha = conf.camposAutoFecha || [];

    // Generar un input por cada campo (saltando PK y campos de fecha auto)
    conf.campos.forEach((campo, index) => {
        if (index === 0) return;             // Saltar la clave primaria
        if (autoFecha.includes(campo)) return; // Saltar fecha automática

        const divCampo = document.createElement('div');
        divCampo.className = 'campo';

        const label     = document.createElement('label');
        label.textContent = campo.replace(/_/g, ' ');

        const input     = document.createElement('input');
        input.type        = 'text';
        input.name        = campo;
        input.required    = true;
        input.placeholder = 'Escriba aquí...';

        divCampo.appendChild(label);
        divCampo.appendChild(input);
        contenedorCampos.appendChild(divCampo);
    });

    // Mostrar el panel de formulario
    contenedorForm.classList.replace('contenedor-form-desactivado', 'contenedor-form-activado');
}

/**
Oculta el panel del formulario de inserción (desliza hacia abajo).
 */
function cerrarModal() {
    const contenedorForm = document.querySelector('.contenedor-form-desactivado, .contenedor-form-activado');
    if (contenedorForm) {
        contenedorForm.classList.replace('contenedor-form-activado', 'contenedor-form-desactivado');
    }
}

// ─── CARGA INICIAL DE LA PÁGINA ────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', async function () {
    // 1. Verificar sesión antes de mostrar nada
    const sesion = await verificarSesion();
    if (!sesion) return;

    // 2. Mostrar el nombre del usuario en el encabezado (si existe el elemento)
    const elNombre = document.getElementById('nombre-usuario');
    if (elNombre) elNombre.textContent = sesion.nombre;

    // 3. Actualizar el área de auth del navbar (nombre + botón de logout)
    actualizarNavAuth(sesion);

    // 4. Mostrar u ocultar secciones según el rol del usuario
    aplicarRol(sesion.rol);

    // 4b. Quitar la clase que oculta todo mientras se carga el rol (anti-flash)
    document.body.classList.remove('cargando-rol');

    // 5. Vincular el botón de cerrar modal al cerrarModal() si existe
    const btnCerrar = document.querySelector('.cerrar');
    if (btnCerrar) {
        btnCerrar.addEventListener('click', cerrarModal);
    }

    // 6. Detectar qué tablas de la configTablas están presentes en esta página
    //    y cargar sus datos automáticamente
    Object.keys(configTablas).forEach(nombreTabla => {
        if (document.getElementById(nombreTabla)) {
            actualizarVistaTabla(nombreTabla);
        }
    });
});

// ─── INSERTAR DATOS ───────────────────────────────────────────────────────

/**
Listener global de submit para el formulario de inserción.
Recopila los campos del form, los envía a insercion.php y recarga la tabla.
 */
document.addEventListener('submit', async function (event) {
    if (!event.target.classList.contains('form-insert')) return;
    event.preventDefault();

    const nombreTabla = event.target.name;
    const conf        = configTablas[nombreTabla];
    if (!conf) return;

    const formData = new FormData(event.target);
    formData.append('accion', conf.accionInsertar);

    try {
        const respuesta = await fetch('insercion.php', { method: 'POST', body: formData });
        if (respuesta.ok) {
            alert('¡Registro guardado!');
            actualizarVistaTabla(nombreTabla);
            cerrarModal();
        }
    } catch (error) {
        console.error('Error al insertar:', error);
    }
});

// ─── CONSULTAR Y RENDERIZAR TABLA ─────────────────────────────────────────

/**
Consulta consulta.php con la acción correspondiente a la tabla
y llama a renderizarTabla con los datos obtenidos.
 */
async function actualizarVistaTabla(nombreTabla) {
    if (!nombreTabla || !configTablas[nombreTabla]) {
        console.error('actualizarVistaTabla: tabla inválida →', nombreTabla);
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
        console.error('Error al recargar tabla:', e);
    }
}

/**
Renderiza las filas de una tabla a partir de un array de objetos.
Usa el <template id="molde-fila-{nombreTabla}"> presente en el HTML
como plantilla base para cada fila.

El primer campo de la configuración (PK/ID) se oculta visualmente
pero permanece en el DOM para las operaciones de edición y eliminación.
 */
function renderizarTabla(listaDatos, nombreTabla) {
    const contenedor   = document.getElementById(nombreTabla);
    const molde        = document.getElementById(`molde-fila-${nombreTabla}`);
    if (!contenedor || !molde) return;

    contenedor.innerHTML = '';
    const camposTabla    = configTablas[nombreTabla].campos;

    // Fix: si la plantilla tiene celda de acciones, asegurar que thead también tenga su <th>
    // para que el color de fondo de la cabecera cubra toda la fila (incluyendo la última columna).
    if (molde.content.querySelector('td.acciones')) {
        const table = contenedor.closest('table');
        if (table) {
            const theadRow = table.querySelector('thead tr');
            if (theadRow && !theadRow.querySelector('.th-acciones')) {
                const thAcciones = document.createElement('th');
                thAcciones.className = 'th-acciones';
                theadRow.appendChild(thAcciones);
            }
        }
    }

    listaDatos.forEach(item => {
        const copia      = molde.content.cloneNode(true);
        const fila       = copia.querySelector('tr');
        if (!fila) return;

        // Extraer la celda de acciones del molde antes de borrar el contenido de la fila
        const celdaAcciones = fila.querySelector('.acciones');
        fila.innerHTML = '';

        // Crear una celda por cada campo de la configuración
        camposTabla.forEach((campo, idx) => {
            const td       = document.createElement('td');
            td.classList.add(`col-${campo}`);
            td.textContent = item[campo] ?? '';
            // El primer campo (PK) se oculta visualmente pero queda en el DOM
            if (idx === 0) td.style.display = 'none';
            fila.appendChild(td);
        });

        // Reincorporar la celda de acciones al final
        if (celdaAcciones) fila.appendChild(celdaAcciones);

        contenedor.appendChild(fila);
    });
}

// ─── EDITAR / ELIMINAR / GUARDAR ──────────────────────────────────────────

/**
Listener global de clic para los botones de acción en las filas de tabla
  btn-eliminar: elimina el registro vía eliminacion.php
  btn-editar: convierte las celdas en inputs editables
  btn-guardar: envía los cambios a actualizacion.php y recarga la tabla
 */
document.addEventListener('click', async function (event) {
    const boton = event.target;

    // Ignorar clics que no sean en botones de acción de tabla
    if (!boton.classList.contains('btn-eliminar') &&
        !boton.classList.contains('btn-editar')   &&
        !boton.classList.contains('btn-guardar')) return;

    const filaElemento = boton.closest('tr');
    if (!filaElemento) return;

    const tbody = filaElemento.closest('tbody');
    if (!tbody) return;

    const nombreTabla = tbody.id;
    if (!configTablas[nombreTabla]) return;

    tablaActiva         = nombreTabla;
    const configuracion = configTablas[nombreTabla];
    const nombreId      = configuracion.campos[0]; // Primer campo = PK
    const celdaId       = filaElemento.querySelector(`.col-${nombreId}`);
    if (!celdaId) return;

    // Obtener el valor de la PK (puede estar en un input si ya se estaba editando)
    const idRegistro = celdaId.querySelector('input')
        ? celdaId.querySelector('input').value
        : celdaId.textContent;

    // ── ELIMINAR ──────────────────────────────────────────────
    if (boton.classList.contains('btn-eliminar')) {
        if (!confirm(`¿Eliminar ID: ${idRegistro}?`)) return;

        try {
            const formData = new FormData();
            formData.append(nombreId, idRegistro);
            formData.append('accion', configuracion.accionEliminar);
            const res = await fetch('eliminacion.php', { method: 'POST', body: formData });
            // Si la eliminación fue exitosa, quitar la fila del DOM directamente
            if (res.ok) filaElemento.remove();
        } catch (e) { console.error('Error al eliminar:', e); }
    }

    // ── EDITAR: convertir celdas en inputs ────────────────────
    else if (boton.classList.contains('btn-editar')) {
        configuracion.campos.forEach(campo => {
            const td = filaElemento.querySelector(`.col-${campo}`);
            if (!td) return;
            const val = td.textContent;
            // Reemplazar el texto por un input con el valor actual
            td.innerHTML = `<input type="text" value="${val}" class="edit-input" data-campo="${campo}" style="width:100%">`;
        });
        // Cambiar el botón de editar a guardar
        boton.textContent = '✔️';
        boton.classList.replace('btn-editar', 'btn-guardar');
    }

    // ── GUARDAR: enviar cambios al servidor ───────────────────
    else if (boton.classList.contains('btn-guardar')) {
        const datos = new FormData();
        datos.append(nombreId, idRegistro);

        // Recolectar los valores de todos los inputs en edición
        filaElemento.querySelectorAll('.edit-input').forEach(input => {
            datos.append(input.dataset.campo, input.value);
        });

        try {
            datos.append('accion', configuracion.accionActualizar);
            const res = await fetch('actualizacion.php', { method: 'POST', body: datos });
            if (res.ok) {
                alert('Actualizado con éxito');
                actualizarVistaTabla(nombreTabla); // Recargar la tabla completa
            }
        } catch (e) { console.error('Error al actualizar:', e); }
    }
});
