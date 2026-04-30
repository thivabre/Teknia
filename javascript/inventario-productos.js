/**
inventario-productos.js — Listado y detalle de inventarios de productos.

Usa tarjetas.js para el renderizado genérico y el modal de detalle.
Usa tablas.js para la verificación de sesión.
 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        // ── 1. Cargar inventarios y sucursales ─────────────────────
        let inventarios = [], sucursales = [];
        try {
            const [resI, resS] = await Promise.all([
                fetch('consulta.php?accion=consulta_inv_productos_detalle'),
                fetch('consulta.php?accion=consulta_sucursales')
            ]);
            const dataI = await resI.json();
            const dataS = await resS.json();
            if (Array.isArray(dataI)) inventarios = dataI;
            if (Array.isArray(dataS)) sucursales  = dataS;
        } catch (e) { console.error('Error cargando inventarios de productos:', e); }

        // Mapear id_inv_productos → id_sucursal
        const invSucMap = {};
        sucursales.forEach(s => { invSucMap[s.id_inv_productos] = s.id_sucursal; });

        // Agrupar filas por id_inv_productos (la consulta puede devolver 1 fila por producto)
        const invMap = {};
        inventarios.forEach(row => {
            const key = row.id_inv_productos;
            if (!invMap[key]) {
                invMap[key] = { id_inv_productos: key, cantidad_prod: row.cantidad_prod, primer_nombre: null };
            }
            // Guardar el primer nombre de producto para mostrarlo en la card
            if (row.nombre_producto && !invMap[key].primer_nombre) {
                invMap[key].primer_nombre = row.nombre_producto;
            }
        });
        const invList = Object.values(invMap);

        // ── 2. Modal e inicialización ──────────────────────────────
        initModal('modal-detalle', 'backdrop-detalle', 'btn-cerrar-detalle');

        renderCards(
            'cards-inv-prod',
            invList,
            (inv) => {
                const idSuc = invSucMap[inv.id_inv_productos]
                    ? `Sucursal #${invSucMap[inv.id_inv_productos]}`
                    : 'Sin sucursal asignada';
                return {
                    badge:         'Prod.',
                    avatarContent: `#${inv.id_inv_productos}`,
                    avatarStyle:   'background:linear-gradient(135deg,#059669,#047857);font-size:12px',
                    nombre:        `Inventario #${inv.id_inv_productos}`,
                    subs:          [idSuc, inv.primer_nombre || 'Sin productos']
                };
            },
            (inv) => {
                const idSuc = invSucMap[inv.id_inv_productos]
                    ? `Sucursal #${invSucMap[inv.id_inv_productos]}`
                    : 'Sin sucursal asignada';
                mostrarDetalle(inv, idSuc);
            },
            'No hay inventarios de productos.'
        );

        // ── 3. Función de detalle del modal ────────────────────────
        async function mostrarDetalle(inv, idSuc) {
            // Abrir modal con estado de carga
            abrirModal('modal-detalle', {
                titulo:    `Inventario #${inv.id_inv_productos}`,
                subtitulo: `Inventario de Productos — ${idSuc}`,
                contenidoHtml: `
                    <div class="detalle-campos" style="margin-bottom:14px">
                        <div class="detalle-campo"><label>ID Inventario</label><span>#${inv.id_inv_productos}</span></div>
                        <div class="detalle-campo"><label>Sucursal</label><span>${idSuc}</span></div>
                        <div class="detalle-campo"><label>Cantidad total</label><span>${inv.cantidad_prod} unidades</span></div>
                    </div>
                    <p style="font-size:10px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--t3);margin-bottom:8px">
                        Productos en este inventario
                    </p>
                    <div id="tabla-items-prod-wrap">
                        <p style="color:var(--t3);font-size:12px">Cargando productos…</p>
                    </div>
                `
            });

            // Cargar artículos del inventario de forma diferida
            try {
                const res   = await fetch(`consulta.php?accion=consulta_inv_productos_items&id_inv_productos=${inv.id_inv_productos}`);
                const items = await res.json();
                const wrap  = document.getElementById('tabla-items-prod-wrap');
                if (!wrap) return;

                let filas = '';
                if (!Array.isArray(items) || !items.length) {
                    filas = '<tr><td colspan="3" style="text-align:center;color:var(--t3)">Sin productos cargados.</td></tr>';
                } else {
                    filas = items.map(it => `
                        <tr>
                            <td>${it.nombre_art_rep}</td>
                            <td>${it.tipo_art_rep}</td>
                            <td style="max-width:160px;white-space:normal">${it.fallas || '—'}</td>
                        </tr>
                    `).join('');
                }

                wrap.innerHTML = `
                    <table class="detalle-tabla">
                        <thead><tr><th>Nombre</th><th>Tipo</th><th>Fallas</th></tr></thead>
                        <tbody>${filas}</tbody>
                    </table>
                `;
            } catch (e) {
                const wrap = document.getElementById('tabla-items-prod-wrap');
                if (wrap) wrap.innerHTML = '<p style="color:#991b1b;font-size:12px">Error al cargar productos.</p>';
                console.error(e);
            }
        }
    });
})();
