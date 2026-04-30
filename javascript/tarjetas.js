/**
 * tarjetas.js — Motor genérico de tarjetas (cards) y panel de detalle.
 *
 * Este archivo centraliza toda la lógica compartida entre las páginas que
 * usan el patrón "grilla de cards + modal de detalle":
 *   personal-clientes.js, personal-empleados.js, personal-jefes.js,
 *   personal-jefes_sucursal.js, inventario-repuestos.js,
 *   inventario-productos.js, sucursales-informacion.js,
 *   servicios-presupuestos.js
 *
 * Las funciones se exponen de forma global (sin módulos ES) para que
 * puedan usarse desde cualquier script cargado con <script src="...">.
 */

// ─── RENDERIZADO DE CARDS ──────────────────────────────────────────────────

/**
 * Renderiza una grilla de tarjetas a partir de un array de datos.
 *
 * @param {string}   gridId       - ID del elemento .cards-grid en el DOM.
 * @param {Array}    items        - Array de objetos de datos a mostrar.
 * @param {Function} buildCard    - Función (item) => { badge, badgeStyle,
 *                                  avatarContent, avatarStyle, nombre, subs }
 *                                  que devuelve los datos visuales de cada card.
 * @param {Function} onCardClick  - Función (item, cardEl) => void
 *                                  llamada al hacer clic en una tarjeta.
 * @param {string}   [mensajeVacio] - Texto a mostrar si el array está vacío.
 */
function renderCards(gridId, items, buildCard, onCardClick, mensajeVacio = 'No hay registros.') {
    const grid = document.getElementById(gridId);
    if (!grid) return;

    // Si no hay datos, mostrar mensaje de estado vacío
    if (!Array.isArray(items) || !items.length) {
        grid.innerHTML = `<div class="cards-empty">${mensajeVacio}</div>`;
        return;
    }

    grid.innerHTML = '';

    items.forEach(item => {
        // Obtener la configuración visual del card para este item
        const cfg = buildCard(item);

        const card = document.createElement('div');
        card.className = 'card-item';

        // Líneas sub-texto bajo el nombre principal (subtítulos)
        const subsHtml = (cfg.subs || [])
            .map((s, i) => `<div class="card-sub"${i > 0 ? ' style="margin-top:4px"' : ''}>${s}</div>`)
            .join('');

        card.innerHTML = `
            <span class="card-badge"${cfg.badgeStyle ? ` style="${cfg.badgeStyle}"` : ''}>${cfg.badge}</span>
            <div class="card-avatar"${cfg.avatarStyle ? ` style="${cfg.avatarStyle}"` : ''}>${cfg.avatarContent}</div>
            <div class="card-nombre">${cfg.nombre}</div>
            ${subsHtml}
        `;

        // Vincular el clic al callback externo
        card.addEventListener('click', () => onCardClick(item, card));
        grid.appendChild(card);
    });
}

// ─── MODAL DE DETALLE ──────────────────────────────────────────────────────

/**
 * Inicializa los eventos de cierre de un modal de detalle.
 * Debe llamarse una vez por página, en el DOMContentLoaded.
 *
 * @param {string} modalId    - ID del elemento .detalle-modal.
 * @param {string} backdropId - ID del .detalle-backdrop (fondo oscuro).
 * @param {string} closeBtnId - ID del botón de cerrar (×).
 */
function initModal(modalId, backdropId, closeBtnId) {
    const cerrar = () => cerrarModal(modalId);

    const backdrop = document.getElementById(backdropId);
    const closeBtn = document.getElementById(closeBtnId);

    if (backdrop) backdrop.addEventListener('click', cerrar);
    if (closeBtn) closeBtn.addEventListener('click', cerrar);
}

/**
 * Abre el modal de detalle e inyecta su contenido dinámicamente.
 * Funciona con cualquier página que tenga la estructura estándar del modal:
 *   #detalle-titulo, #detalle-subtitulo, #detalle-contenido, #detalle-acciones-wrap
 *
 * @param {string} modalId - ID del .detalle-modal a abrir.
 * @param {Object} config
 *   @param {string}   config.titulo        - Título principal del modal.
 *   @param {string}   config.subtitulo     - Subtítulo (rol, categoría, etc.).
 *   @param {string}   config.contenidoHtml - HTML interno para #detalle-contenido.
 *   @param {string}   [config.accionesHtml]- HTML para #detalle-acciones-wrap
 *                                            (opcional: botones de acción).
 *   @param {Function} [config.onReady]     - Callback invocado después de
 *                                            insertar el HTML en el DOM.
 *                                            Útil para agregar event listeners.
 */
function abrirModal(modalId, { titulo, subtitulo, contenidoHtml, accionesHtml = '', onReady } = {}) {
    const tituloEl    = document.getElementById('detalle-titulo');
    const subEl       = document.getElementById('detalle-subtitulo');
    const contenidoEl = document.getElementById('detalle-contenido');
    const accionesEl  = document.getElementById('detalle-acciones-wrap');
    const modal       = document.getElementById(modalId);

    if (tituloEl)    tituloEl.textContent    = titulo        || '—';
    if (subEl)       subEl.textContent       = subtitulo     || '';
    if (contenidoEl) contenidoEl.innerHTML   = contenidoHtml || '';
    if (accionesEl)  accionesEl.innerHTML    = accionesHtml  || '';

    // Ejecutar callback post-render (ej: agregar listeners a botones inyectados)
    if (typeof onReady === 'function') onReady();

    if (modal) modal.classList.add('activo');
}

/**
 * Cierra el modal de detalle quitando la clase 'activo'.
 *
 * @param {string} modalId - ID del .detalle-modal a cerrar.
 */
function cerrarModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.remove('activo');
}
