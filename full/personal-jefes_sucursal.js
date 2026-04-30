/**
 * personal-jefes_sucursal.js — Listado y detalle de jefes de sucursal.
 *
 * Usa tarjetas.js para el renderizado genérico y el modal de detalle.
 * Usa tablas.js para la verificación de sesión.
 *
 * Funcionalidad exclusiva:
 *   - Cargar jefes de sucursal y sus contratos
 *   - Mostrar detalle del modal con datos laborales
 *   - Botón de ascenso a Jefe General (solo jefe_general)
 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        const rolActual = sesion.rol;

        // ── 1. Cargar datos en paralelo ────────────────────────────
        let empleados = [], contratos = [];
        try {
            const [resE, resC] = await Promise.all([
                fetch('consulta.php?accion=consulta_jefes_sucursal'),
                fetch('consulta.php?accion=consulta_contratos_detalle')
            ]);
            empleados = await resE.json();
            contratos = await resC.json();
        } catch (e) { console.error('Error cargando jefes de sucursal:', e); }

        const contratoMap = {};
        contratos.forEach(c => contratoMap[c.id_contrato_emple] = c);

        // ── 2. Modal e inicialización ──────────────────────────────
        initModal('modal-detalle', 'backdrop-detalle', 'btn-cerrar-detalle');

        renderCards(
            'cards-jefes-suc',
            empleados,
            (e) => ({
                badge:         'J. Sucursal',
                avatarContent: (e.nombre_emple[0] + e.apellido_emple[0]).toUpperCase(),
                avatarStyle:   'background:linear-gradient(135deg,#7c3aed,#2563eb)',
                nombre:        `${e.nombre_emple} ${e.apellido_emple}`,
                subs:          [`DNI: ${e.dni_emple}`]
            }),
            (e) => mostrarDetalle(e, rolActual, contratoMap),
            'No hay jefes de sucursal registrados.'
        );

        // ── 3. Función de detalle ──────────────────────────────────
        function mostrarDetalle(e, rol, cMap) {
            const c = cMap[e.id_contrato_emple] || {};

            const contenidoHtml = `
                <div class="detalle-campos">
                    <div class="detalle-campo"><label>Nombre</label><span>${e.nombre_emple}</span></div>
                    <div class="detalle-campo"><label>Apellido</label><span>${e.apellido_emple}</span></div>
                    <div class="detalle-campo"><label>DNI</label><span>${e.dni_emple}</span></div>
                    <div class="detalle-campo"><label>Teléfono</label><span>${e.telefono_emple}</span></div>
                    <div class="detalle-campo full-width"><label>Dirección</label><span>${e.direccion}</span></div>
                    <div class="detalle-campo"><label>Horas trabajadas</label><span>${e.horas_trabajdas}</span></div>
                    <div class="detalle-campo"><label>Horas extra</label><span>${e.horas_extra}</span></div>
                    <div class="detalle-campo"><label>Sucursal</label><span>#${e.id_sucursal}</span></div>
                    <div class="detalle-campo"><label>Turno</label><span>${c.turno || '—'}</span></div>
                    <div class="detalle-campo"><label>Fecha contratación</label><span>${c.fecha_cont || '—'}</span></div>
                    <div class="detalle-campo"><label>ID seguro</label><span>${e.id_seguro}</span></div>
                </div>
            `;

            const accionesHtml = rol === 'jefe_general' ? `
                <div class="detalle-acciones">
                    <button class="btn-ascender" id="btn-asc-jsuc">▲ Ascender a Jefe General</button>
                    <div class="msg-estado" id="msg-asc-jsuc"></div>
                </div>
            ` : '';

            abrirModal('modal-detalle', {
                titulo:        `${e.nombre_emple} ${e.apellido_emple}`,
                subtitulo:     'Jefe de Sucursal',
                contenidoHtml,
                accionesHtml,
                onReady: rol === 'jefe_general'
                    ? () => inicializarAscenso(e)
                    : undefined
            });
        }

        // ── 4. Botón de ascenso a Jefe General ────────────────────
        function inicializarAscenso(e) {
            const btn = document.getElementById('btn-asc-jsuc');
            if (!btn) return;

            btn.addEventListener('click', async function () {
                if (!confirm('¿Ascender a Jefe General? Perderá su rol de Jefe de Sucursal.')) return;

                const msgEl = document.getElementById('msg-asc-jsuc');
                this.disabled    = true;
                this.textContent = 'Procesando…';

                const fd = new FormData();
                fd.append('accion',      'update_jefe_general');
                fd.append('id_empleado', e.id_empleado);

                try {
                    const res   = await fetch('actualizacion.php', { method: 'POST', body: fd });
                    const datos = await res.json();

                    if (datos.estado === 'ok') {
                        msgEl.className   = 'msg-estado ok';
                        msgEl.textContent = '✔ Ascendido a Jefe General correctamente.';
                        setTimeout(() => location.reload(), 1400);
                    } else {
                        msgEl.className   = 'msg-estado error';
                        msgEl.textContent = 'Error: ' + datos.mensaje;
                    }
                } catch (err) {
                    msgEl.className   = 'msg-estado error';
                    msgEl.textContent = 'Error de conexión.';
                } finally {
                    this.disabled    = false;
                    this.textContent = '▲ Ascender a Jefe General';
                }
            });
        }
    });
})();
