/**
 * personal-empleados.js — Listado y detalle de empleados regulares.
 *
 * Usa tarjetas.js para el renderizado genérico y el modal de detalle.
 * Usa tablas.js para la verificación de sesión.
 *
 * Funcionalidad exclusiva de este archivo:
 *   - Cargar empleados y sus contratos asociados
 *   - Mostrar detalle laboral (turno, fecha contratación, horas)
 *   - Botón de ascenso a Jefe de Sucursal (solo jefe_general)
 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        const rolActual = sesion.rol;

        // ── 1. Cargar empleados y contratos en paralelo ────────────
        let empleados = [], contratos = [];
        try {
            const [resE, resC] = await Promise.all([
                fetch('consulta.php?accion=consulta_empleados_regulares'),
                fetch('consulta.php?accion=consulta_contratos_detalle')
            ]);
            empleados = await resE.json();
            contratos = await resC.json();
        } catch (e) { console.error('Error cargando empleados:', e); }

        // Indexar contratos por ID para acceso rápido en el modal
        const contratoMap = {};
        contratos.forEach(c => contratoMap[c.id_contrato_emple] = c);

        // ── 2. Inicializar el modal ────────────────────────────────
        initModal('modal-detalle', 'backdrop-detalle', 'btn-cerrar-detalle');

        // ── 3. Renderizar la grilla de cards ───────────────────────
        renderCards(
            'cards-empleados',
            empleados,
            (e) => ({
                badge:         'Empleado',
                avatarContent: (e.nombre_emple[0] + e.apellido_emple[0]).toUpperCase(),
                nombre:        `${e.nombre_emple} ${e.apellido_emple}`,
                subs:          [`DNI: ${e.dni_emple}`]
            }),
            (e) => mostrarDetalle(e, rolActual, contratoMap),
            'No hay empleados registrados.'
        );

        // ── 4. Función de detalle ──────────────────────────────────
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

            // Botón de ascenso solo para jefe_general
            const accionesHtml = rol === 'jefe_general' ? `
                <div class="detalle-acciones">
                    <button class="btn-ascender" id="btn-asc-emple">▲ Ascender a Jefe de Sucursal</button>
                    <div class="msg-estado" id="msg-asc-emple"></div>
                </div>
            ` : '';

            abrirModal('modal-detalle', {
                titulo:        `${e.nombre_emple} ${e.apellido_emple}`,
                subtitulo:     'Empleado',
                contenidoHtml,
                accionesHtml,
                onReady: rol === 'jefe_general'
                    ? () => inicializarAscenso(e)
                    : undefined
            });
        }

        // ── 5. Lógica del botón de ascenso ────────────────────────
        function inicializarAscenso(e) {
            const btn = document.getElementById('btn-asc-emple');
            if (!btn) return;

            btn.addEventListener('click', async function () {
                const msgEl = document.getElementById('msg-asc-emple');
                this.disabled    = true;
                this.textContent = 'Procesando…';

                const fd = new FormData();
                fd.append('accion',      'update_jefe_sucursal');
                fd.append('id_empleado', e.id_empleado);

                try {
                    const res   = await fetch('actualizacion.php', { method: 'POST', body: fd });
                    const datos = await res.json();

                    if (datos.estado === 'ok') {
                        msgEl.className   = 'msg-estado ok';
                        msgEl.textContent = '✔ Ascendido a Jefe de Sucursal correctamente.';
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
                    this.textContent = '▲ Ascender a Jefe de Sucursal';
                }
            });
        }
    });
})();
