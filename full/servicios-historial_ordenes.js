/**
 * servicios-historial_ordenes.js — Historial de órdenes finalizadas.
 *
 * Usa tablas.js para la verificación de sesión.
 *
 * Los clientes ven solo sus órdenes históricas.
 * El resto de los roles ve todas las órdenes del historial.
 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        const tbody = document.getElementById('tbody-historial');
        tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;color:var(--t3);padding:20px">Cargando…</td></tr>';

        try {
            // URL diferenciada: cliente solo ve su historial personal
            const url = sesion.rol === 'cliente'
                ? `consulta.php?accion=consulta_historial_ordenes_por_cliente&id_cliente=${sesion.id_referencia}`
                : 'consulta.php?accion=consulta_historial_ordenes';

            const res    = await fetch(url);
            const ordenes = await res.json();

            if (!Array.isArray(ordenes) || !ordenes.length) {
                tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;color:var(--t3);padding:24px">No hay órdenes en el historial.</td></tr>';
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
                    <td style="white-space:nowrap">${o.fecha_orden}</td>
                    <td style="white-space:nowrap">${o.fecha_entrega}</td>
                    <td>Sucursal #${o.id_sucursal}</td>
                    <td style="white-space:nowrap">${o.fecha_factura || '—'}</td>
                `;
                tbody.appendChild(tr);
            });

        } catch (e) {
            tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;color:#991b1b;padding:20px">Error al cargar el historial.</td></tr>';
            console.error(e);
        }
    });
})();
