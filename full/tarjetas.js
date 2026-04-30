/**
Renderiza una grilla de tarjetas a partir de un array de datos.
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
Inicializa los eventos de cierre de un modal de detalle.
Debe llamarse una vez por página, en el DOMContentLoaded.
 */
function initModal(modalId, backdropId, closeBtnId) {
    const cerrar = () => cerrarModal(modalId);

    const backdrop = document.getElementById(backdropId);
    const closeBtn = document.getElementById(closeBtnId);

    if (backdrop) backdrop.addEventListener('click', cerrar);
    if (closeBtn) closeBtn.addEventListener('click', cerrar);
}

/**
Abre el modal de detalle e inyecta su contenido dinámicamente.
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
Cierra el modal de detalle quitando la clase 'activo'.
 */
function cerrarModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.remove('activo');
}
