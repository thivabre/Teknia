// servicios-ordenes_activas.js — Gestión de órdenes activas y registro de entregas.
(function () {
    // ID de la orden seleccionada para entrega
    let idOrdenActual = null;

    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        const rolActual     = sesion.rol;
        const puedeEntregar = ['empleado', 'jefe_sucursal', 'jefe_general'].includes(rolActual);

        // Mostrar columna de acciones solo a personal autorizado
        if (puedeEntregar) {
            document.getElementById('th-accion').style.display = '';
        }

        await cargarOrdenes(sesion, puedeEntregar);

        // Control del modal de entrega
        function cerrarModal() {
            document.getElementById('modal-entrega').classList.remove('activo');
            const msgEl = document.getElementById('msg-entrega');
            if (msgEl) { msgEl.className = 'msg-estado'; msgEl.textContent = ''; }
            idOrdenActual = null;
        }

        document.getElementById('cerrar-modal-entrega').addEventListener('click', cerrarModal);
        document.getElementById('btn-cancelar-entrega').addEventListener('click', cerrarModal);
        document.getElementById('backdrop-entrega').addEventListener('click', cerrarModal);

        // Confirmar y registrar entrega
        document.getElementById('btn-confirmar-entrega').addEventListener('click', async function () {
            if (!idOrdenActual) return;

            const msgEl  = document.getElementById('msg-entrega');
            const mostrar = (txt, tipo) => { msgEl.textContent = txt; msgEl.className = 'msg-estado ' + tipo; };

            this.disabled    = true;
            this.textContent = 'Procesando…';

            try {
                const fd = new FormData();
                fd.append('accion', 'insert_orden_entrega');
                fd.append('id_orden_servicio', idOrdenActual);

                const res   = await fetch('insercion.php', { method: 'POST', body: fd });
                const datos = await res.json();

                if (datos.estado === 'ok') {
                    mostrar(`✔ Entrega registrada (#${datos.id_orden_entrega}).`, 'ok');
                    setTimeout(async () => {
                        cerrarModal();
                        await cargarOrdenes(sesion, puedeEntregar);
                    }, 1500);
                } else {
                    // Validar si el error es por falta de pago
                    const msg = datos.mensaje.includes('factura')
                        ? '⚠ El cliente debe pagar la factura primero.'
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

    // Carga y renderiza las órdenes según el rol
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

                if (puedeEntregar) {
                    const tdAccion = document.createElement('td');
                    tdAccion.className = 'acciones';
                    tdAccion.style.cssText = 'min-width:unset;width:90px;';

                    const btnEntregar = document.createElement('button');
                    btnEntregar.className   = 'btn-editar';
                    btnEntregar.title       = 'Registrar entrega';
                    btnEntregar.textContent = '📦';
                    btnEntregar.addEventListener('click', (e) => {
                        e.stopPropagation();
                        abrirModal(o.id_orden_servicio);
                    });

                    const btnCancelar = document.createElement('button');
                    btnCancelar.className   = 'btn-eliminar';
                    btnCancelar.title       = 'Cancelar orden';
                    btnCancelar.textContent = '🚫';
                    btnCancelar.addEventListener('click', async (e) => {
                        e.stopPropagation();
                        if (!confirm(`¿Cancelar la orden #${o.id_orden_servicio}?`)) return;
                        try {
                            const fd = new FormData();
                            fd.append('accion', 'cancelar_orden_servicio');
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
                            alert('Error de conexión.');
                        }
                    });

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
            tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;color:#991b1b;padding:20px">Error al cargar datos.</td></tr>';
            console.error(e);
        }
    }

    // Configura y muestra el modal de entrega
    function abrirModal(idOrden) {
        idOrdenActual = idOrden;
        document.getElementById('entrega-subtitulo').textContent = 'Orden #' + idOrden;
        const msgEl = document.getElementById('msg-entrega');
        if (msgEl) { msgEl.className = 'msg-estado'; msgEl.textContent = ''; }
        document.getElementById('modal-entrega').classList.add('activo');
    }
})();
