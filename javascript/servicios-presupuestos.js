/**
servicios-presupuestos.js — Listado y detalle de presupuestos de servicio.

Usa tarjetas.js para el renderizado genérico y el modal de detalle.
Usa tablas.js para la verificación de sesión.
 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        const rolActual = sesion.rol;

        // ── 1. Cargar presupuestos según el rol ────────────────────
        let presupuestos = [];
        try {
            const url = rolActual === 'cliente'
                ? `consulta.php?accion=consulta_presupuestos_completo_por_cliente&id_cliente=${sesion.id_referencia}`
                : 'consulta.php?accion=consulta_presupuestos_completo';
            const res = await fetch(url);
            presupuestos = await res.json();
        } catch (e) { console.error('Error cargando presupuestos:', e); }

        // ── 2. Modal e inicialización ──────────────────────────────
        initModal('modal-detalle', 'backdrop-detalle', 'btn-cerrar-detalle');

        renderCards(
            'cards-presupuestos',
            presupuestos,
            (p) => ({
                badge:         'Presup.',
                avatarContent: `#${p.id_presupuesto}`,
                avatarStyle:   'background:linear-gradient(135deg,#7c3aed,#6d28d9);font-size:12px',
                nombre:        `Presupuesto #${p.id_presupuesto}`,
                subs: [
                    p.fecha_orden || 'Sin fecha',
                    `<strong style="color:var(--blue)">Total: $${Number(p.precio_reparacion_tot).toLocaleString('es-AR')}</strong>`
                ]
            }),
            (p) => mostrarDetalle(p),
            'No hay presupuestos disponibles.'
        );

        // ── 3. Función de detalle del modal ────────────────────────
        function mostrarDetalle(p) {
            // Parsear el campo concatenado de repuestos
            // Formato del string: "nombre|tipo|precio|precio_mo;;nombre|tipo|precio|precio_mo"
            let filas = '';
            if (p.repuestos_detalle) {
                const items = p.repuestos_detalle.split(';;').map(s => {
                    const [nombre, tipo, precio, pmo] = s.split('|');
                    const precioN = parseFloat(precio) || 0;
                    const pmoN   = parseFloat(pmo)    || 0;
                    return { nombre, tipo, precio: precioN, pmo: pmoN, subtotal: precioN + pmoN };
                });
                filas = items.map(it => `
                    <tr>
                        <td>${it.nombre || '—'}</td>
                        <td>${it.tipo   || '—'}</td>
                        <td>$${it.precio.toLocaleString('es-AR')}</td>
                        <td>$${it.pmo.toLocaleString('es-AR')}</td>
                        <td><strong>$${it.subtotal.toLocaleString('es-AR')}</strong></td>
                    </tr>
                `).join('');
            } else {
                filas = '<tr><td colspan="5" style="text-align:center;color:var(--t3)">Sin repuestos detallados.</td></tr>';
            }

            const total = Number(p.precio_reparacion_tot).toLocaleString('es-AR');

            abrirModal('modal-detalle', {
                titulo:    `Presupuesto #${p.id_presupuesto}`,
                subtitulo: `Fecha de orden: ${p.fecha_orden || '—'}`,
                contenidoHtml: `
                    <div class="detalle-campos" style="margin-bottom:14px">
                        <div class="detalle-campo"><label>Fecha de orden</label><span>${p.fecha_orden || '—'}</span></div>
                        <div class="detalle-campo"><label>N° Presupuesto</label><span>#${p.id_presupuesto}</span></div>
                    </div>
                    <p style="font-size:10px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--t3);margin-bottom:8px">
                        Repuestos utilizados
                    </p>
                    <table class="detalle-tabla">
                        <thead><tr>
                            <th>Producto / repuesto</th>
                            <th>Tipo</th>
                            <th>Precio unidad</th>
                            <th>Mano de obra</th>
                            <th>Subtotal</th>
                        </tr></thead>
                        <tbody>${filas}</tbody>
                    </table>
                    <!-- Footer con el total del presupuesto -->
                    <div class="detalle-footer">
                        <span class="detalle-total-label">Total del presupuesto</span>
                        <span class="detalle-total-valor">$${total}</span>
                    </div>
                `
            });
        }
    });
})();
