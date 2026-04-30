/**
inventario-repuestos.js — Listado y detalle de inventarios de repuestos.

Usa tarjetas.js para el renderizado genérico y el modal de detalle.

Usa tablas.js para la verificación de sesión.
 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        // ── 1. Cargar inventarios y sucursales en paralelo ─────────
        let inventarios = [], sucursales = [];
        try {
            const [resI, resS] = await Promise.all([
                fetch('consulta.php?accion=consulta_inv_repuestos_detalle'),
                fetch('consulta.php?accion=consulta_sucursales')
            ]);
            const dataI = await resI.json();
            const dataS = await resS.json();
            if (Array.isArray(dataI)) inventarios = dataI;
            if (Array.isArray(dataS)) sucursales  = dataS;
        } catch (e) { console.error('Error cargando inventarios de repuestos:', e); }

        // Mapear id_inv_repuestos → id_sucursal para mostrarlo en la card
        const invSucMap = {};
        sucursales.forEach(s => { invSucMap[s.id_inv_repuestos] = s.id_sucursal; });

        // ── 2. Modal e inicialización ──────────────────────────────
        initModal('modal-detalle', 'backdrop-detalle', 'btn-cerrar-detalle');

        renderCards(
            'cards-inv-rep',
            inventarios,
            (inv) => {
                const idSuc = invSucMap[inv.id_inv_repuestos]
                    ? `Sucursal #${invSucMap[inv.id_inv_repuestos]}`
                    : 'Sin sucursal asignada';
                return {
                    badge:         'Rep.',
                    avatarContent: `#${inv.id_inv_repuestos}`,
                    avatarStyle:   'background:linear-gradient(135deg,#0891b2,#0e7490);font-size:12px',
                    nombre:        `Inventario #${inv.id_inv_repuestos}`,
                    subs:          [idSuc, `Stock: ${inv.cantidad_rep} unidades`]
                };
            },
            (inv) => {
                const idSuc = invSucMap[inv.id_inv_repuestos]
                    ? `Sucursal #${invSucMap[inv.id_inv_repuestos]}`
                    : 'Sin sucursal asignada';
                mostrarDetalle(inv, idSuc);
            },
            'No hay inventarios de repuestos.'
        );

        // ── 3. Función de detalle del modal ────────────────────────
        async function mostrarDetalle(inv, idSuc) {
            // Mostrar el modal con un estado "Cargando" mientras se piden los items
            abrirModal('modal-detalle', {
                titulo:    `Inventario #${inv.id_inv_repuestos}`,
                subtitulo: `Inventario de Repuestos — ${idSuc}`,
                contenidoHtml: `
                    <div class="detalle-campos" style="margin-bottom:14px">
                        <div class="detalle-campo"><label>ID Inventario</label><span>#${inv.id_inv_repuestos}</span></div>
                        <div class="detalle-campo"><label>Sucursal</label><span>${idSuc}</span></div>
                        <div class="detalle-campo"><label>Cantidad total</label><span>${inv.cantidad_rep} unidades</span></div>
                    </div>
                    <p style="font-size:10px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--t3);margin-bottom:8px">
                        Repuestos en este inventario
                    </p>
                    <div id="tabla-items-wrap">
                        <p style="color:var(--t3);font-size:12px">Cargando repuestos…</p>
                    </div>
                `
            });

            // Cargar los items del inventario de forma diferida
            try {
                const res   = await fetch(`consulta.php?accion=consulta_inv_repuestos_items&id_inv_repuestos=${inv.id_inv_repuestos}`);
                const items = await res.json();
                const wrap  = document.getElementById('tabla-items-wrap');
                if (!wrap) return;

                // Construir filas de la tabla de repuestos
                let filas = '';
                const yaAgregados = new Set();

                if (!Array.isArray(items) || !items.length) {
                    filas = '<tr><td colspan="4" style="text-align:center;color:var(--t3)">Sin repuestos registrados.</td></tr>';
                } else {
                    filas = items.map(it => {
                        yaAgregados.add(it.nombre_rep);
                        return `<tr>
                            <td>${it.nombre_rep}</td>
                            <td>${it.tipo_rep}</td>
                            <td>$${it.precio_rep ?? '—'}</td>
                            <td>$${it.precio_mano_obra}</td>
                        </tr>`;
                    }).join('');
                }

                // Cargar repuestos disponibles para agregar al inventario
                let opcionesAgregar = '<option value="0">Cargando repuestos…</option>';
                try {
                    const resR = await fetch('consulta.php?accion=consulta_repuestos_detalle');
                    const reps = await resR.json();
                    if (Array.isArray(reps)) {
                        const disponibles = reps.filter(r => !yaAgregados.has(r.nombre_rep));
                        opcionesAgregar = disponibles.length
                            ? '<option value="0">Seleccione un repuesto…</option>' +
                              disponibles.map(r => `<option value="${r.id_repuesto}">${r.nombre_rep} (${r.tipo_rep}) — $${r.precio_unidad}</option>`).join('')
                            : '<option value="0">— Todos los repuestos ya fueron agregados —</option>';
                    }
                } catch (e) { console.error('Error cargando repuestos:', e); }

                // Inyectar tabla + formulario de alta de repuesto
                wrap.innerHTML = `
                    <table class="detalle-tabla">
                        <thead><tr>
                            <th>Nombre</th><th>Tipo</th><th>Precio</th><th>Mano de obra</th>
                        </tr></thead>
                        <tbody>${filas}</tbody>
                    </table>
                    <div style="margin-top:18px;padding-top:14px;border-top:1px solid var(--bdr)">
                        <p style="font-size:10px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--t3);margin-bottom:10px">
                            Agregar repuesto a este inventario
                        </p>
                        <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
                            <select id="sel-add-rep" style="flex:1;min-width:200px;padding:6px 10px;border-radius:6px;border:1px solid var(--bdr);background:var(--bg);color:var(--t1)">
                                ${opcionesAgregar}
                            </select>
                            <button id="btn-add-rep" style="padding:6px 16px;border-radius:6px;background:var(--blue);color:#fff;border:none;cursor:pointer;font-weight:600">
                                + Agregar
                            </button>
                        </div>
                        <p id="msg-add-rep" style="font-size:12px;margin-top:6px;min-height:16px"></p>
                    </div>
                `;

                // Evento del botón "Agregar repuesto"
                document.getElementById('btn-add-rep').addEventListener('click', async () => {
                    const msg   = document.getElementById('msg-add-rep');
                    const idRep = parseInt(document.getElementById('sel-add-rep').value) || 0;
                    if (!idRep) { msg.textContent = 'Seleccione un repuesto.'; msg.style.color = '#991b1b'; return; }

                    const fd = new FormData();
                    fd.append('accion',           'agregar_repuesto_a_inventario');
                    fd.append('id_inv_repuestos', inv.id_inv_repuestos);
                    fd.append('id_repuesto',       idRep);

                    try {
                        const r = await fetch('insercion.php', { method: 'POST', body: fd });
                        const d = await r.json();
                        if (d.estado === 'ok') {
                            msg.textContent = '✔ Repuesto agregado.';
                            msg.style.color = '#16a34a';
                            // Recargar el modal con los datos actualizados
                            setTimeout(() => mostrarDetalle(
                                Object.assign({}, inv, { cantidad_rep: inv.cantidad_rep + 1 }),
                                idSuc
                            ), 600);
                        } else {
                            msg.textContent = 'Error: ' + d.mensaje;
                            msg.style.color = '#991b1b';
                        }
                    } catch (e) {
                        msg.textContent = 'Error de conexión.';
                        msg.style.color = '#991b1b';
                    }
                });

            } catch (e) {
                const wrap = document.getElementById('tabla-items-wrap');
                if (wrap) wrap.innerHTML = '<p style="color:#991b1b;font-size:12px">Error al cargar repuestos.</p>';
                console.error(e);
            }
        }
    });
})();
