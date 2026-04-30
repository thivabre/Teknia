/**
 * servicios-facturas.js — Gestión de facturas y pagos.
 *
 * Usa tablas.js para la verificación de sesión.
 *
 * Funcionalidad:
 *   - Listar facturas existentes filtradas por rol (cliente ve solo las suyas)
 *   - Mostrar formulario para registrar nuevo pago + factura
 *   - Poblar el select de órdenes sin factura y el de garantías
 *   - Enviar el pago a insercion.php con accion=insert_pago_y_factura
 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        const rolActual = sesion.rol;
        const esCliente = rolActual === 'cliente';

        // ── 1. Cargar y mostrar facturas existentes ────────────────
        await cargarFacturas(sesion);

        // ── 2. Poblar el select de órdenes sin factura ─────────────
        // Los clientes ven solo sus órdenes; el resto ve todas
        try {
            const urlOrd = esCliente
                ? `consulta.php?accion=consulta_ordenes_sin_factura_por_cliente&id_cliente=${sesion.id_referencia}`
                : 'consulta.php?accion=consulta_ordenes_sin_factura';
            const resOrd = await fetch(urlOrd);
            const ordenes = await resOrd.json();
            const sel = document.getElementById('sel-orden');

            sel.innerHTML = '<option value="">Seleccione una orden…</option>';
            if (!ordenes.length) {
                sel.innerHTML = '<option value="">No hay órdenes pendientes de pago</option>';
                sel.disabled  = true;
            } else {
                ordenes.forEach(o => {
                    const opt = document.createElement('option');
                    opt.value       = o.id_orden_servicio;
                    opt.textContent = `Orden #${o.id_orden_servicio} — ${o.nombre_art_rep} (${o.tipo_art_rep}) | $${o.precio_reparacion_tot}`;
                    sel.appendChild(opt);
                });
            }
        } catch (e) { console.error('Error cargando órdenes:', e); }

        // ── 3. Poblar el select de garantías ──────────────────────
        try {
            const resG = await fetch('consulta.php?accion=consulta_garantias_lista');
            const garantias = await resG.json();
            const selG = document.getElementById('sel-garantia');
            selG.innerHTML = '<option value="">Seleccione garantía…</option>';
            garantias.forEach(g => {
                const opt = document.createElement('option');
                opt.value       = g.id_garantia_servicio;
                opt.textContent = `${g.tipo_garantia} — ${g.tiempo_garantia}`;
                selG.appendChild(opt);
            });
        } catch (e) { console.error('Error cargando garantías:', e); }

        // ── 4. Toggle del formulario de nueva factura ──────────────
        const btnAbrir   = document.getElementById('btn-nueva-factura');
        const formWrap   = document.getElementById('form-nueva-factura');
        const btnCerrarF = document.getElementById('btn-cerrar-form');

        if (btnAbrir)   btnAbrir.addEventListener('click', () => formWrap.classList.toggle('activo'));
        if (btnCerrarF) btnCerrarF.addEventListener('click', () => { formWrap.classList.remove('activo'); limpiarForm(); });

        const btnCancelarF = document.getElementById('btn-cancelar-factura');
        if (btnCancelarF) btnCancelarF.addEventListener('click', () => { formWrap.classList.remove('activo'); limpiarForm(); });

        const backdropF = document.getElementById('backdrop-form-factura');
        if (backdropF) backdropF.addEventListener('click', () => { formWrap.classList.remove('activo'); limpiarForm(); });

        // ── 5. Envío del formulario de nueva factura ───────────────
        const btnSubmit = document.getElementById('btn-crear-factura');
        if (btnSubmit) {
            btnSubmit.addEventListener('click', async function () {
                const msgEl  = document.getElementById('msg-factura');
                const mostrar = (txt, tipo) => { msgEl.textContent = txt; msgEl.className = 'msg-estado ' + tipo; };

                const idOrden     = parseInt(document.getElementById('sel-orden').value)     || 0;
                const banco       = document.getElementById('fac-banco').value.trim();
                const cuenta      = document.getElementById('fac-cuenta').value.trim();
                const comprobante = document.getElementById('fac-comprobante').value.trim();
                const idGarantia  = parseInt(document.getElementById('sel-garantia').value)  || 0;

                // Validaciones de campos obligatorios
                if (!idOrden)     { mostrar('Seleccione la orden de servicio.', 'error'); return; }
                if (!banco)       { mostrar('Ingrese el banco o medio de pago.', 'error'); return; }
                if (!cuenta)      { mostrar('Ingrese el número de cuenta.', 'error'); return; }
                if (!comprobante) { mostrar('Ingrese el comprobante.', 'error'); return; }
                if (!idGarantia)  { mostrar('Seleccione una garantía.', 'error'); return; }

                this.disabled    = true;
                this.textContent = 'Procesando…';

                try {
                    const fd = new FormData();
                    fd.append('accion',              'insert_pago_y_factura');
                    fd.append('id_orden_servicio',   idOrden);
                    fd.append('id_garantia_servicio', idGarantia);
                    fd.append('nombre_banco',        banco);
                    fd.append('numero_cuenta',       cuenta);
                    fd.append('comprobante',         comprobante);

                    const res    = await fetch('insercion.php', { method: 'POST', body: fd });
                    const datos  = await res.json();

                    if (datos.estado === 'ok') {
                        mostrar(`✔ Factura #${datos.id_factura_servicio} registrada correctamente.`, 'ok');
                        limpiarForm();

                        // Esperar un momento y luego recargar la tabla + el select de órdenes
                        setTimeout(async () => {
                            formWrap.classList.remove('activo');
                            await cargarFacturas(sesion);

                            // Actualizar el select de órdenes sin factura
                            const urlOrd2 = esCliente
                                ? `consulta.php?accion=consulta_ordenes_sin_factura_por_cliente&id_cliente=${sesion.id_referencia}`
                                : 'consulta.php?accion=consulta_ordenes_sin_factura';
                            const resOrd2 = await fetch(urlOrd2);
                            const ords2   = await resOrd2.json();
                            const sel2    = document.getElementById('sel-orden');
                            sel2.disabled = !ords2.length;
                            sel2.innerHTML = ords2.length
                                ? '<option value="">Seleccione una orden…</option>' +
                                  ords2.map(o => `<option value="${o.id_orden_servicio}">Orden #${o.id_orden_servicio} — ${o.nombre_art_rep} | $${o.precio_reparacion_tot}</option>`).join('')
                                : '<option value="">No hay órdenes pendientes de pago</option>';
                        }, 1500);
                    } else {
                        mostrar('Error: ' + datos.mensaje, 'error');
                    }
                } catch (err) {
                    mostrar('Error de conexión.', 'error');
                    console.error(err);
                } finally {
                    this.disabled    = false;
                    this.textContent = 'Registrar pago y factura';
                }
            });
        }

        /**
         * Limpia los campos del formulario de nueva factura
         * y resetea el mensaje de estado.
         */
        function limpiarForm() {
            ['fac-banco', 'fac-cuenta', 'fac-comprobante'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.value = '';
            });
            const selOrd = document.getElementById('sel-orden');
            const selGar = document.getElementById('sel-garantia');
            if (selOrd) selOrd.value = '';
            if (selGar) selGar.value = '';
            const msgEl = document.getElementById('msg-factura');
            if (msgEl) msgEl.className = 'msg-estado';
        }
    });

    /**
     * Consulta las facturas según el rol del usuario y las renderiza
     * en el tbody #tbody-facturas.
     * Los clientes ven solo sus facturas; el resto ve todas.
     *
     * @param {{rol, id_referencia}} sesion
     */
    async function cargarFacturas(sesion) {
        const tbody = document.getElementById('tbody-facturas');
        if (!tbody) return;

        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:var(--t3);padding:20px">Cargando…</td></tr>';

        try {
            const url = sesion.rol === 'cliente'
                ? `consulta.php?accion=consulta_facturas_por_cliente&id_cliente=${sesion.id_referencia}`
                : 'consulta.php?accion=consulta_facturas_detalle';

            const res      = await fetch(url);
            const facturas = await res.json();

            if (!Array.isArray(facturas) || !facturas.length) {
                tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:var(--t3);padding:24px">No hay facturas registradas.</td></tr>';
                return;
            }

            tbody.innerHTML = '';
            facturas.forEach(f => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td><strong>#${f.id_factura_servicio}</strong></td>
                    <td>Orden #${f.id_orden_servicio} — ${f.nombre_art_rep}</td>
                    <td>${f.nombre_banco}</td>
                    <td>${f.comprobante}</td>
                    <td><strong>$${Number(f.monto).toLocaleString('es-AR')}</strong></td>
                    <td>${f.tipo_garantia} (${f.tiempo_garantia})</td>
                    <td>${f.fecha_factura}</td>
                `;
                tbody.appendChild(tr);
            });
        } catch (e) {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:#991b1b;padding:20px">Error al cargar facturas.</td></tr>';
            console.error(e);
        }
    }
})();
