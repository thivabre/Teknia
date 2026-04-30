/**
 * servicios-ordenes_activas.js — Listado de órdenes activas y registro de entregas.
 *
 * Usa tablas.js para la verificación de sesión.
 *
 * Roles y funcionalidad:
 *   - cliente        → ve solo sus órdenes activas.
 *   - empleado/jefe  → ve todas las órdenes activas y puede registrar entregas o cancelar.
 *
 * Flujo de entrega:
 *   1. El empleado hace clic en 📦 → se abre el modal de entrega.
 *   2. El sistema verifica que exista una factura del cliente para esa orden.
 *   3. Si existe, se registra la orden de entrega en la DB (insercion.php).
 *   4. Si no existe, se informa que el cliente debe pagar primero.
 */
(function () {
    /** ID de la orden seleccionada en el modal de entrega. */
    let idOrdenActual = null;

    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        const rolActual     = sesion.rol;
        const puedeEntregar = ['empleado', 'jefe_sucursal', 'jefe_general'].includes(rolActual);

        // Mostrar la columna de "Acción" solo para quienes pueden entregar
        if (puedeEntregar) {
            document.getElementById('th-accion').style.display = '';
        }

        // Cargar las órdenes activas al iniciar
        await cargarOrdenes(sesion, puedeEntregar);

        // ── Eventos del modal de entrega ───────────────────────────
        function cerrarModal() {
            document.getElementById('modal-entrega').classList.remove('activo');
            const msgEl = document.getElementById('msg-entrega');
            if (msgEl) { msgEl.className = 'msg-estado'; msgEl.textContent = ''; }
            idOrdenActual = null;
        }

        document.getElementById('cerrar-modal-entrega').addEventListener('click', cerrarModal);
        document.getElementById('btn-cancelar-entrega').addEventListener('click', cerrarModal);
        document.getElementById('backdrop-entrega').addEventListener('click', cerrarModal);

        // ── Confirmación de entrega ────────────────────────────────
        document.getElementById('btn-confirmar-entrega').addEventListener('click', async function () {
            if (!idOrdenActual) return;

            const msgEl  = document.getElementById('msg-entrega');
            const mostrar = (txt, tipo) => { msgEl.textContent = txt; msgEl.className = 'msg-estado ' + tipo; };

            this.disabled    = true;
            this.textContent = 'Procesando…';

            try {
                const fd = new FormData();
                fd.append('accion',            'insert_orden_entrega');
                fd.append('id_orden_servicio', idOrdenActual);

                const res   = await fetch('insercion.php', { method: 'POST', body: fd });
                const datos = await res.json();

                if (datos.estado === 'ok') {
                    mostrar(`✔ Entrega registrada. Orden de entrega #${datos.id_orden_entrega}.`, 'ok');
                    setTimeout(async () => {
                        cerrarModal();
                        await cargarOrdenes(sesion, puedeEntregar);
                    }, 1500);
                } else {
                    // Si el error menciona "factura", mostrar un mensaje específico
                    const msg = datos.mensaje.includes('factura')
                        ? '⚠ El cliente aún no registró el pago. Debe hacerlo en la sección Facturas.'
                        : 'Error: ' + datos.mensaje;
                    mostrar(msg, 'error');
                }
            } catch (err) {
                mostrar('Error de conexión.', 'error');
                console.error(err);
            } finally {
                this.disabled    = false;
                this.textContent = 'Confirmar entrega';
            }
        });
    });

    /**
     * Carga las órdenes activas desde el servidor y las renderiza en la tabla.
     * Los clientes solo ven sus propias órdenes.
     *
     * @param {{rol, id_referencia}} sesion
     * @param {boolean}              puedeEntregar - Si true, agrega columna de acciones.
     */
    async function cargarOrdenes(sesion, puedeEntregar) {
        const tbody = document.getElementById('tbody-ordenes');
        tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;color:var(--t3);padding:20px">Cargando…</td></tr>';

        try {
            const url = sesion.rol === 'cliente'
                ? `consulta.php?accion=consulta_ordenes_activas_por_cliente&id_cliente=${sesion.id_referencia}`
                : 'consulta.php?accion=consulta_ordenes_activas';

            const res     = await fetch(url);
            const ordenes = await res.json();

            if (!Array.isArray(ordenes) || !ordenes.length) {
                tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;color:var(--t3);padding:24px">No hay órdenes activas.</td></tr>';
                return;
            }

            tbody.innerHTML = '';
            ordenes.forEach(o => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td><strong>#${o.id_orden_servicio}</strong></td>
                    <td>${o.nombre_art_rep}</td>
                    <td>${o.tipo_art_rep}</td>
                    <td style="max-width:160px;white-space:normal">${o.fallas || '—'}</td>
                    <td>${o.fecha_orden}</td>
                    <td>${o.fecha_est_fin}</td>
                    <td>Sucursal #${o.id_sucursal}</td>
                `;

                // Agregar celda de acciones solo para empleados y jefes
                if (puedeEntregar) {
                    const tdAccion = document.createElement('td');
                    tdAccion.className = 'acciones';
                    tdAccion.style.cssText = 'min-width:unset;width:90px;';

                    // Botón de registrar entrega
                    const btnEntregar = document.createElement('button');
                    btnEntregar.className   = 'btn-editar';
                    btnEntregar.title       = 'Registrar entrega';
                    btnEntregar.textContent = '📦';
                    btnEntregar.addEventListener('click', (e) => {
                        e.stopPropagation();
                        abrirModal(o.id_orden_servicio);
                    });

                    // Botón de cancelar orden
                    const btnCancelar = document.createElement('button');
                    btnCancelar.className   = 'btn-eliminar';
                    btnCancelar.title       = 'Cancelar orden';
                    btnCancelar.textContent = '🚫';
                    btnCancelar.addEventListener('click', async (e) => {
                        e.stopPropagation();
                        if (!confirm(`¿Cancelar la orden #${o.id_orden_servicio}?`)) return;
                        try {
                            const fd = new FormData();
                            fd.append('accion',            'cancelar_orden_servicio');
                            fd.append('id_orden_servicio', o.id_orden_servicio);
                            const res   = await fetch('actualizacion.php', { method: 'POST', body: fd });
                            const datos = await res.json();
                            if (datos.estado === 'ok' || res.ok) {
                                await cargarOrdenes(sesion, puedeEntregar);
                            } else {
                                alert('No se pudo cancelar: ' + (datos.mensaje || 'error'));
                            }
                        } catch (err) {
                            console.error(err);
                            alert('Error de conexión al cancelar.');
                        }
                    });

                    // Contenedor de los dos botones en columna
                    const btnWrap = document.createElement('div');
                    btnWrap.style.cssText = 'display:flex;flex-direction:column;align-items:center;gap:4px;';
                    btnWrap.appendChild(btnEntregar);
                    btnWrap.appendChild(btnCancelar);
                    tdAccion.appendChild(btnWrap);
                    tr.appendChild(tdAccion);
                }

                tbody.appendChild(tr);
            });
        } catch (e) {
            tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;color:#991b1b;padding:20px">Error al cargar órdenes.</td></tr>';
            console.error(e);
        }
    }

    /**
     * Abre el modal de registro de entrega para una orden específica.
     *
     * @param {number} idOrden - ID de la orden de servicio.
     */
    function abrirModal(idOrden) {
        idOrdenActual = idOrden;
        document.getElementById('entrega-subtitulo').textContent = 'Orden #' + idOrden;
        const msgEl = document.getElementById('msg-entrega');
        if (msgEl) { msgEl.className = 'msg-estado'; msgEl.textContent = ''; }
        document.getElementById('modal-entrega').classList.add('activo');
    }
})();
