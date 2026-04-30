/**
sucursales-informacion.js — Listado y detalle de sucursales.

Usa tarjetas.js para el renderizado genérico y el modal de detalle.
Usa tablas.js para la verificación de sesión.
 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        // ── 1. Cargar sucursales con dirección completa ────────────
        let sucursales = [];
        try {
            const res = await fetch('consulta.php?accion=consulta_sucursales_completo');
            sucursales = await res.json();
        } catch (e) { console.error('Error cargando sucursales:', e); }

        // ── 2. Modal e inicialización ──────────────────────────────
        initModal('modal-detalle', 'backdrop-detalle', 'btn-cerrar-detalle');

        renderCards(
            'cards-sucursales',
            sucursales,
            (s) => ({
                badge:         'Sucursal',
                avatarContent: `#${s.id_sucursal}`,
                avatarStyle:   'background:linear-gradient(135deg,#1e40af,#1d4ed8);font-size:13px;font-weight:700',
                nombre:        `Sucursal #${s.id_sucursal}`,
                subs:          [s.direccion, `${s.ciudad}, ${s.provincia}`]
            }),
            (s) => mostrarDetalle(s),
            'No hay sucursales registradas.'
        );

        // ── 3. Función de detalle del modal ────────────────────────
        function mostrarDetalle(s) {
            abrirModal('modal-detalle', {
                titulo:    `Sucursal #${s.id_sucursal}`,
                subtitulo: `${s.ciudad}, ${s.provincia}`,
                contenidoHtml: `
                    <div class="detalle-campos">
                        <div class="detalle-campo full-width">
                            <label>Dirección</label>
                            <span>${s.direccion}</span>
                        </div>
                        <div class="detalle-campo"><label>Código postal</label><span>${s.cod_postal_suc}</span></div>
                        <div class="detalle-campo"><label>Barrio</label><span>${s.barrio}</span></div>
                        <div class="detalle-campo"><label>Ciudad</label><span>${s.ciudad}</span></div>
                        <div class="detalle-campo"><label>Provincia</label><span>${s.provincia}</span></div>
                        <div class="detalle-campo"><label>País</label><span>${s.pais}</span></div>
                        <div class="detalle-campo"><label>Cantidad de empleados</label><span>${s.cant_empleados}</span></div>
                        <div class="detalle-campo"><label>Reparaciones hechas</label><span>${s.reparaciones_hechas}</span></div>
                        <div class="detalle-campo"><label>ID Impuestos</label><span>#${s.id_impuestos}</span></div>
                        <div class="detalle-campo"><label>ID Inv. Productos</label><span>#${s.id_inv_productos}</span></div>
                        <div class="detalle-campo"><label>ID Inv. Repuestos</label><span>#${s.id_inv_repuestos}</span></div>
                    </div>
                `
            });
        }
    });
})();
