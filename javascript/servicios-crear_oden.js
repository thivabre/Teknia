/**
servicios-crear_oden.js — Formulario de creación de órdenes de servicio.

Usa tablas.js para la verificación de sesión.

 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        const rolActual = sesion.rol;

        // Mostrar campo de ID de cliente solo para empleados y jefes
        if (['empleado', 'jefe_sucursal', 'jefe_general'].includes(rolActual)) {
            document.getElementById('campo-cliente-id').style.display = '';
        }

        // ── 1. Poblar select de sucursales ─────────────────────────
        try {
            const resSuc    = await fetch('consulta.php?accion=consulta_sucursales_id');
            const sucursales = await resSuc.json();
            const selSuc    = document.getElementById('sel-sucursal');
            selSuc.innerHTML = '<option value="">Seleccione una sucursal…</option>';
            sucursales.forEach(s => {
                const opt = document.createElement('option');
                opt.value       = s.id_sucursal;
                opt.textContent = 'Sucursal #' + s.id_sucursal;
                selSuc.appendChild(opt);
            });
        } catch (e) { console.error('Error cargando sucursales:', e); }

        // ── 2. Poblar los tres selects de repuestos ────────────────
        // Cache de precios por ID de repuesto para calcular el precio de M.O. al crear la orden
        const repuestosData = {};
        try {
            const resRep  = await fetch('consulta.php?accion=consulta_repuestos_detalle');
            const repuestos = await resRep.json();

            const selR1 = document.getElementById('sel-repuesto-1');
            const selR2 = document.getElementById('sel-repuesto-2');
            const selR3 = document.getElementById('sel-repuesto-3');

            selR1.innerHTML = '<option value="">Seleccione repuesto 1…</option>';

            repuestos.forEach(r => {
                // Guardar precio para calcular costo total al enviar el formulario
                repuestosData[r.id_repuesto] = {
                    precio_unidad:    r.precio_unidad,
                    precio_mano_obra: r.precio_mano_obra
                };
                const label = `${r.nombre_rep} (${r.tipo_rep}) — $${r.precio_unidad}`;
                [selR1, selR2, selR3].forEach(sel => {
                    const opt = document.createElement('option');
                    opt.value       = r.id_repuesto;
                    opt.textContent = label;
                    sel.appendChild(opt);
                });
            });

            // Mostrar info de mano de obra al cambiar cada select de repuesto
            function actualizarInfoRep(selEl, infoEl) {
                const id   = parseInt(selEl.value);
                const info = repuestosData[id];
                infoEl.textContent = info
                    ? `Mano de obra: $${info.precio_mano_obra} | Precio repuesto: $${info.precio_unidad}`
                    : '';
                infoEl.style.color = 'var(--t2)';
            }

            [[selR1, 'info-rep-1'], [selR2, 'info-rep-2'], [selR3, 'info-rep-3']].forEach(([sel, infoId]) => {
                const infoEl = document.getElementById(infoId);
                sel.addEventListener('change', () => actualizarInfoRep(sel, infoEl));
            });

        } catch (e) { console.error('Error cargando repuestos:', e); }

        // ── 3. Botón de creación de orden ──────────────────────────
        document.getElementById('btn-crear-orden').addEventListener('click', async function () {
            const msgEl    = document.getElementById('msg-orden');
            const mostrarMsg = (texto, tipo) => {
                msgEl.textContent    = texto;
                msgEl.style.display  = 'block';
                msgEl.style.background = tipo === 'ok' ? '#d1fae5' : '#fee2e2';
                msgEl.style.color      = tipo === 'ok' ? '#065f46' : '#991b1b';
            };

            // Determinar id_cliente según el rol
            let idCliente;
            if (rolActual === 'cliente') {
                idCliente = sesion.id_referencia; // El cliente usa su propio ID
            } else {
                idCliente = parseInt(document.getElementById('input-id-cliente').value);
                if (!idCliente) { mostrarMsg('Ingrese el ID del cliente.', 'error'); return; }
            }

            const nombreArt = document.getElementById('input-nombre-art').value.trim();
            const tipoArt   = document.getElementById('input-tipo-art').value.trim();
            const idSuc     = parseInt(document.getElementById('sel-sucursal').value);
            const idRep1    = parseInt(document.getElementById('sel-repuesto-1').value) || 0;
            const idRep2    = parseInt(document.getElementById('sel-repuesto-2').value) || 0;
            const idRep3    = parseInt(document.getElementById('sel-repuesto-3').value) || 0;
            const fallas    = document.getElementById('input-fallas').value.trim();

            // Calcular precio de mano de obra sumando la M.O. de cada repuesto elegido
            const idsSeleccionados = [idRep1, idRep2, idRep3].filter(id => id > 0);
            const precioMO = idsSeleccionados.reduce((sum, id) => {
                return sum + (repuestosData[id]?.precio_mano_obra || 0);
            }, 0);

            // Validaciones
            if (!nombreArt) { mostrarMsg('El nombre del artículo es requerido.', 'error'); return; }
            if (!tipoArt)   { mostrarMsg('El tipo de artículo es requerido.', 'error'); return; }
            if (!idSuc)     { mostrarMsg('Seleccione una sucursal.', 'error'); return; }
            if (!idRep1)    { mostrarMsg('Seleccione al menos el Repuesto 1.', 'error'); return; }

            const fd = new FormData();
            fd.append('accion',            'crear_orden_completa');
            fd.append('nombre_art_rep',    nombreArt);
            fd.append('tipo_art_rep',      tipoArt);
            fd.append('fallas',            fallas);
            fd.append('precio_mano_obra',  precioMO);
            fd.append('id_repuesto_1',     idRep1);
            fd.append('id_repuesto_2',     idRep2);
            fd.append('id_repuesto_3',     idRep3);
            fd.append('id_sucursal',       idSuc);
            fd.append('id_cliente',        idCliente);

            this.disabled    = true;
            this.textContent = 'Creando…';

            try {
                const res   = await fetch('insercion.php', { method: 'POST', body: fd });
                const datos = await res.json();

                if (datos.estado === 'ok') {
                    mostrarMsg(
                        `✔ Orden #${datos.id_orden_servicio} creada. Total: $${datos.precio_reparacion_tot}. Fecha est. fin: ${datos.fecha_est_fin}`,
                        'ok'
                    );
                    // Limpiar todos los campos del formulario
                    document.getElementById('input-nombre-art').value = '';
                    document.getElementById('input-tipo-art').value   = '';
                    document.getElementById('input-fallas').value     = '';
                    document.getElementById('sel-sucursal').value     = '';
                    document.getElementById('sel-repuesto-1').value   = '';
                    document.getElementById('sel-repuesto-2').value   = '0';
                    document.getElementById('sel-repuesto-3').value   = '0';
                    ['info-rep-1','info-rep-2','info-rep-3'].forEach(id => {
                        document.getElementById(id).textContent = '';
                    });
                    if (rolActual !== 'cliente') document.getElementById('input-id-cliente').value = '';
                } else {
                    mostrarMsg('Error: ' + datos.mensaje, 'error');
                }
            } catch (err) {
                mostrarMsg('Error de conexión.', 'error');
                console.error(err);
            } finally {
                this.disabled    = false;
                this.textContent = 'Crear orden';
            }
        });
    });
})();
