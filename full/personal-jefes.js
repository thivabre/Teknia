/**
personal-jefes.js — Listado y detalle de jefes generales.

Usa tarjetas.js para el renderizado genérico y el modal de detalle.
Usa tablas.js para la verificación de sesión.
 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        // ── 1. Cargar datos en paralelo ────────────────────────────
        let empleados = [], contratos = [];
        try {
            const [resE, resC] = await Promise.all([
                fetch('consulta.php?accion=consulta_jefes_generales'),
                fetch('consulta.php?accion=consulta_contratos_detalle')
            ]);
            empleados = await resE.json();
            contratos = await resC.json();
        } catch (e) { console.error('Error cargando jefes generales:', e); }

        const contratoMap = {};
        contratos.forEach(c => contratoMap[c.id_contrato_emple] = c);

        // ── 2. Modal e inicialización ──────────────────────────────
        initModal('modal-detalle', 'backdrop-detalle', 'btn-cerrar-detalle');

        renderCards(
            'cards-jefes',
            empleados,
            (e) => ({
                badge:         'J. General',
                badgeStyle:    'background:#fef3c7;color:#92400e',
                avatarContent: (e.nombre_emple[0] + e.apellido_emple[0]).toUpperCase(),
                avatarStyle:   'background:linear-gradient(135deg,#d97706,#b45309)',
                nombre:        `${e.nombre_emple} ${e.apellido_emple}`,
                subs:          [`DNI: ${e.dni_emple}`]
            }),
            (e) => mostrarDetalle(e, contratoMap),
            'No hay jefes generales registrados.'
        );

        // ── 3. Función de detalle ──────────────────────────────────
        function mostrarDetalle(e, cMap) {
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
                <!-- Nota informativa: rango máximo, no hay ascenso posible -->
                <p style="font-size:11px;color:var(--t3);margin-top:12px;text-align:center">
                    Jefe General — rango máximo, no se puede ascender más.
                </p>
            `;

            // Sin acciones de ascenso para este rol
            abrirModal('modal-detalle', {
                titulo:        `${e.nombre_emple} ${e.apellido_emple}`,
                subtitulo:     'Jefe General',
                contenidoHtml
            });
        }
    });
})();
