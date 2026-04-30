/**
 * personal-clientes.js — Listado y detalle de clientes.

Usa tarjetas.js para el renderizado genérico de cards y el modal de detalle.
Usa tablas.js para la verificación de sesión (verificarSesion).
 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        const rolActual = sesion.rol;

        // ── 1. Cargar datos de clientes ────────────────────────────
        let clientes = [];
        try {
            const res = await fetch('consulta.php?accion=consulta_clientes_detalle');
            clientes = await res.json();
        } catch (e) { console.error('Error cargando clientes:', e); }

        // ── 2. Inicializar el modal (eventos de cierre) ────────────
        initModal('modal-detalle', 'backdrop-detalle', 'btn-cerrar-detalle');

        // ── 3. Renderizar la grilla de cards ───────────────────────
        renderCards(
            'cards-clientes',
            clientes,
            // buildCard: define la apariencia visual de cada tarjeta
            (c) => ({
                badge:          'Cliente',
                avatarContent:  (c.nombre_cli[0] + c.apellido_cli[0]).toUpperCase(),
                nombre:         `${c.nombre_cli} ${c.apellido_cli}`,
                subs:           [`DNI: ${c.dni_cli}`]
            }),
            // onCardClick: abre el modal con el detalle del cliente
            (c) => mostrarDetalle(c, rolActual),
            'No hay clientes registrados.'
        );

        // ── 4. Función que arma y muestra el modal de detalle ──────
        function mostrarDetalle(c, rol) {
            // HTML de los campos informativos del cliente
            const contenidoHtml = `
                <div class="detalle-campos">
                    <div class="detalle-campo"><label>Nombre</label><span>${c.nombre_cli}</span></div>
                    <div class="detalle-campo"><label>Apellido</label><span>${c.apellido_cli}</span></div>
                    <div class="detalle-campo"><label>DNI</label><span>${c.dni_cli}</span></div>
                    <div class="detalle-campo"><label>Teléfono</label><span>${c.telefono_cli}</span></div>
                    <div class="detalle-campo full-width">
                        <label>Dirección</label>
                        <span>${c.direccion} (CP: ${c.cod_postal_cli})</span>
                    </div>
                </div>
            `;

            // El botón de ascenso solo se muestra al jefe_general
            const tieneOrdenes = parseInt(c.total_ordenes) > 0;
            const accionesHtml = rol === 'jefe_general' ? `
                <div class="detalle-acciones">
                    <button class="btn-ascender" id="btn-asc-cli">▲ Ascender a Empleado</button>
                    ${tieneOrdenes ? `
                    <div class="ascenso-bloqueado" id="msg-bloqueado-ascenso" style="display:none">
                        <p style="font-size:12px;color:#e55;font-weight:600;margin:10px 0 4px">
                            ✖ Este cliente no posee los requisitos para el ascenso.
                        </p>
                        <p style="font-size:11px;color:var(--t2);margin:0">
                            Requisito: el cliente no debe tener ninguna orden de servicio asociada
                            (actualmente posee ${c.total_ordenes} orden${c.total_ordenes > 1 ? 'es' : ''}).
                        </p>
                    </div>` : ''}
                    <div class="ascenso-extra" id="subform-ascenso">
                        <p style="font-size:11px;color:var(--t2);font-weight:600">
                            Datos requeridos para el nuevo empleado:
                        </p>
                        <div>
                            <label>Contrato</label>
                            <select id="asc-contrato"><option value="0">Cargando…</option></select>
                        </div>
                        <div>
                            <label>Sucursal</label>
                            <select id="asc-sucursal"><option value="0">Cargando…</option></select>
                        </div>
                        <div>
                            <label>Seguro</label>
                            <select id="asc-seguro"><option value="0">Cargando…</option></select>
                        </div>
                        <div id="msg-ascenso" class="msg-estado"></div>
                        <button class="btn-confirmar-ascenso" id="btn-confirmar-asc">Confirmar ascenso</button>
                    </div>
                </div>
            ` : '';

            // Abrir el modal con el contenido construido
            abrirModal('modal-detalle', {
                titulo:        `${c.nombre_cli} ${c.apellido_cli}`,
                subtitulo:     'Cliente',
                contenidoHtml,
                accionesHtml,
                // onReady: se ejecuta DESPUÉS de que el HTML está en el DOM
                onReady: rol === 'jefe_general'
                    ? () => inicializarAscenso(c)
                    : undefined
            });
        }

        // ── 5. Lógica del formulario de ascenso (jefe_general only) ──
        async function inicializarAscenso(c) {
            const btnAsc   = document.getElementById('btn-asc-cli');
            const subform  = document.getElementById('subform-ascenso');
            const btnConf  = document.getElementById('btn-confirmar-asc');

            // Alternar visibilidad del subformulario al hacer clic
            btnAsc.addEventListener('click', () => {
                const bloqueado = document.getElementById('msg-bloqueado-ascenso');
                if (bloqueado) {
                    // Cliente con órdenes: solo mostrar/ocultar el mensaje de bloqueo
                    bloqueado.style.display = bloqueado.style.display === 'none' ? 'block' : 'none';
                } else {
                    // Cliente sin órdenes: mostrar/ocultar el subformulario normal
                    subform.classList.toggle('visible');
                }
            });

            // Poblar los selects desde la base de datos en paralelo
            try {
                const [rC, rS, rSeg] = await Promise.all([
                    fetch('consulta.php?accion=consulta_contratos_disponibles'),
                    fetch('consulta.php?accion=consulta_sucursales'),
                    fetch('consulta.php?accion=consulta_seguro')
                ]);
                const contratos  = await rC.json();
                const sucursales = await rS.json();
                const seguros    = await rSeg.json();

                // Rellenar select de contratos
                const selC = document.getElementById('asc-contrato');
                selC.innerHTML = '<option value="0">Seleccione contrato…</option>';
                (contratos || []).forEach(ct => {
                    selC.innerHTML += `<option value="${ct.id_contrato_emple}">
                        #${ct.id_contrato_emple} — ${ct.turno} | $${ct.sueldo_hora}/h
                    </option>`;
                });

                // Rellenar select de sucursales
                const selS = document.getElementById('asc-sucursal');
                selS.innerHTML = '<option value="0">Seleccione sucursal…</option>';
                (sucursales || []).forEach(s => {
                    selS.innerHTML += `<option value="${s.id_sucursal}">Sucursal #${s.id_sucursal}</option>`;
                });

                // Rellenar select de seguros
                const selSeg = document.getElementById('asc-seguro');
                selSeg.innerHTML = '<option value="0">Seleccione seguro…</option>';
                (seguros || []).forEach(sg => {
                    selSeg.innerHTML += `<option value="${sg.id_seguro}">
                        #${sg.id_seguro} — ${sg.tipo_seg} | ${sg.nombre_aseg} | $${sg.monto_aseg}
                    </option>`;
                });
            } catch (e) { console.error('Error cargando opciones de ascenso:', e); }

            // Botón de confirmación: enviar la migración al servidor
            btnConf.addEventListener('click', async function () {
                const msgEl   = document.getElementById('msg-ascenso');
                const mostrar = (txt, tipo) => {
                    msgEl.textContent = txt;
                    msgEl.className   = 'msg-estado ' + tipo;
                };

                const idContrato = parseInt(document.getElementById('asc-contrato').value) || 0;
                const idSucursal = parseInt(document.getElementById('asc-sucursal').value) || 0;
                const idSeguro   = parseInt(document.getElementById('asc-seguro').value)   || 0;

                if (!idContrato) { mostrar('Seleccione un contrato.', 'error'); return; }
                if (!idSucursal) { mostrar('Seleccione una sucursal.', 'error'); return; }
                if (!idSeguro)   { mostrar('Seleccione un seguro.', 'error'); return; }

                const fd = new FormData();
                fd.append('accion',           'migrar_cliente_a_empleado');
                fd.append('id_cliente',       c.id_cliente);
                fd.append('id_contrato_emple', idContrato);
                fd.append('id_sucursal',       idSucursal);
                fd.append('id_seguro',         idSeguro);

                this.disabled    = true;
                this.textContent = 'Procesando…';
                try {
                    const res   = await fetch('migracion_cliente.php', { method: 'POST', body: fd });
                    const datos = await res.json();
                    if (datos.estado === 'ok') {
                        mostrar(`✔ Cliente migrado. Nuevo empleado #${datos.id_empleado}.`, 'ok');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        mostrar('Error: ' + datos.mensaje, 'error');
                    }
                } catch (e) {
                    mostrar('Error de conexión.', 'error');
                } finally {
                    this.disabled    = false;
                    this.textContent = 'Confirmar ascenso';
                }
            });
        }
    });
})();
