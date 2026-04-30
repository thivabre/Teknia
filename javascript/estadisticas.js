// estadisticas.js — Gestión de estadísticas del dashboard según rol de usuario

document.addEventListener('DOMContentLoaded', async function () {
    // verificarSesion definida en tablas.js
    const sesion = await verificarSesion();
    if (!sesion) return;

    const grid  = document.getElementById('stats-grid');
    const label = document.getElementById('label-stats');
    if (!grid) return;

    if (label) label.style.display = '';

    // Cargar estadísticas según el rol
    switch (sesion.rol) {
        case 'cliente':
            await cargarEstadisticasCliente(grid, sesion);
            break;
        case 'empleado':
            await cargarEstadisticasEmpleado(grid, sesion);
            break;
        case 'jefe_sucursal':
            await cargarEstadisticasJefeSucursal(grid, sesion);
            break;
        case 'jefe_general':
            await cargarEstadisticasJefeGeneral(grid, sesion);
            break;
        default:
            grid.innerHTML = '<p style="color:var(--t3);padding:24px">No se encontraron estadísticas para tu rol.</p>';
    }
});

// ─── UTILIDADES ────────────────────────────────────────────────────────────

// Crea e inserta una tarjeta de estadística en el grid
function crearStatCard(grid, { icono, label, href, linkTxt }) {
    const card = document.createElement('div');
    card.className = 'stat-card' + (href ? ' linkeable' : '');

    if (href) card.addEventListener('click', () => window.location.href = href);

    card.innerHTML = `
        <div class="stat-icono">${icono}</div>
        <div class="stat-valor cargando" id="val-${label.replace(/\s+/g,'_')}">…</div>
        <div class="stat-label">${label}</div>
        ${href && linkTxt ? `<a class="stat-link" href="${href}">${linkTxt} →</a>` : ''}
    `;
    grid.appendChild(card);

    return card.querySelector('.stat-valor');
}

// Wrapper de fetch para obtener JSON con manejo de errores
async function fetchJSON(url) {
    try {
        const res  = await fetch(url);
        const data = await res.json();
        return Array.isArray(data) ? data : null;
    } catch (e) {
        console.error('Error al obtener estadísticas:', url, e);
        return null;
    }
}

// Renderiza el valor en la tarjeta o muestra error si es nulo
function setStatVal(el, valor) {
    if (valor === null || valor === undefined) {
        el.textContent = '—';
        el.classList.add('error');
    } else {
        el.textContent = valor;
        el.classList.remove('cargando', 'error');
    }
}

// ─── ESTADÍSTICAS POR ROL ──────────────────────────────────────────────────

// CLIENTE: Actividad personal
async function cargarEstadisticasCliente(grid, sesion) {
    const id = sesion.id_referencia;

    const elOrdenes      = crearStatCard(grid, { icono: '🔧', label: 'Órdenes activas',    href: 'servicios-ordenes_activas.html',   linkTxt: 'Ver órdenes' });
    const elHistorial    = crearStatCard(grid, { icono: '🗂',  label: 'Órdenes en historial', href: 'servicios-historial_ordenes.html', linkTxt: 'Ver historial' });
    const elFacturas     = crearStatCard(grid, { icono: '🧾', label: 'Facturas emitidas',   href: 'servicios-facturas.html',          linkTxt: 'Ver facturas' });
    const elPresupuestos = crearStatCard(grid, { icono: '💰', label: 'Presupuestos',        href: 'servicios-presupuestos.html',      linkTxt: 'Ver presupuestos' });

    const [ordenes, historial, facturas, presupuestos] = await Promise.all([
        fetchJSON(`consulta.php?accion=consulta_ordenes_activas_por_cliente&id_cliente=${id}`),
        fetchJSON(`consulta.php?accion=consulta_historial_ordenes_por_cliente&id_cliente=${id}`),
        fetchJSON(`consulta.php?accion=consulta_facturas_por_cliente&id_cliente=${id}`),
        fetchJSON(`consulta.php?accion=consulta_presupuestos_completo_por_cliente&id_cliente=${id}`)
    ]);

    setStatVal(elOrdenes,      ordenes      ? ordenes.length      : null);
    setStatVal(elHistorial,    historial    ? historial.length    : null);
    setStatVal(elFacturas,     facturas     ? facturas.length     : null);
    setStatVal(elPresupuestos, presupuestos ? presupuestos.length : null);
}

// EMPLEADO: Actividad operativa de sucursal
async function cargarEstadisticasEmpleado(grid, sesion) {
    const elOrdenes     = crearStatCard(grid, { icono: '🔧', label: 'Órdenes activas',      href: 'servicios-ordenes_activas.html',   linkTxt: 'Ver órdenes' });
    const elClientes    = crearStatCard(grid, { icono: '👥', label: 'Clientes registrados', href: 'personal-clientes.html',           linkTxt: 'Ver clientes' });
    const elRepuestos   = crearStatCard(grid, { icono: '🔩', label: 'Repuestos en catálogo', href: 'inventario-catalogo_repuestos.html', linkTxt: 'Ver catálogo' });
    const elInventarios = crearStatCard(grid, { icono: '📦', label: 'Inventarios activos',  href: 'inventario-repuestos.html',        linkTxt: 'Ver inventario' });

    const [ordenes, clientes, repuestos, inventarios] = await Promise.all([
        fetchJSON('consulta.php?accion=consulta_ordenes_activas'),
        fetchJSON('consulta.php?accion=consulta_clientes_detalle'),
        fetchJSON('consulta.php?accion=consulta_repuestos_detalle'),
        fetchJSON('consulta.php?accion=consulta_inv_repuestos_detalle')
    ]);

    setStatVal(elOrdenes,     ordenes     ? ordenes.length     : null);
    setStatVal(elClientes,    clientes    ? clientes.length    : null);
    setStatVal(elRepuestos,   repuestos   ? repuestos.length   : null);
    setStatVal(elInventarios, inventarios ? inventarios.length : null);
}

// JEFE DE SUCURSAL: Operaciones, personal y finanzas de sucursal
async function cargarEstadisticasJefeSucursal(grid, sesion) {
    const elOrdenes    = crearStatCard(grid, { icono: '🔧', label: 'Órdenes activas',    href: 'servicios-ordenes_activas.html',   linkTxt: 'Ver órdenes' });
    const elEmpleados  = crearStatCard(grid, { icono: '👤', label: 'Empleados',           href: 'personal-empleados.html',          linkTxt: 'Ver empleados' });
    const elClientes   = crearStatCard(grid, { icono: '👥', label: 'Clientes',            href: 'personal-clientes.html',           linkTxt: 'Ver clientes' });
    const elGarantias  = crearStatCard(grid, { icono: '🛡',  label: 'Tipos de garantía',  href: 'finanzas-garantias.html',          linkTxt: 'Ver garantías' });
    const elImpuestos  = crearStatCard(grid, { icono: '📊', label: 'Impuestos',           href: 'finanzas-impuestos.html',          linkTxt: 'Ver impuestos' });
    const elFacturas   = crearStatCard(grid, { icono: '🧾', label: 'Facturas totales',    href: 'servicios-facturas.html',          linkTxt: 'Ver facturas' });

    const [ordenes, empleados, clientes, garantias, impuestos, facturas] = await Promise.all([
        fetchJSON('consulta.php?accion=consulta_ordenes_activas'),
        fetchJSON('consulta.php?accion=consulta_empleados_regulares'),
        fetchJSON('consulta.php?accion=consulta_clientes_detalle'),
        fetchJSON('consulta.php?accion=consulta_garantia_servicio'),
        fetchJSON('consulta.php?accion=consulta_impuesto'),
        fetchJSON('consulta.php?accion=consulta_factura_servicio')
    ]);

    setStatVal(elOrdenes,   ordenes   ? ordenes.length   : null);
    setStatVal(elEmpleados, empleados ? empleados.length : null);
    setStatVal(elClientes,  clientes  ? clientes.length  : null);
    setStatVal(elGarantias, garantias ? garantias.length : null);
    setStatVal(elImpuestos, impuestos ? impuestos.length : null);
    setStatVal(elFacturas,  facturas  ? facturas.length  : null);
}

// JEFE GENERAL: Visión global corporativa
async function cargarEstadisticasJefeGeneral(grid, sesion) {
    const elSucursales = crearStatCard(grid, { icono: '🏢', label: 'Sucursales',            href: 'sucursales-informacion.html',     linkTxt: 'Ver sucursales' });
    const elEmpleados  = crearStatCard(grid, { icono: '👤', label: 'Empleados',              href: 'personal-empleados.html',         linkTxt: 'Ver empleados' });
    const elJefes      = crearStatCard(grid, { icono: '⭐', label: 'Jefes de sucursal',     href: 'personal-jefes_sucursal.html',    linkTxt: 'Ver jefes' });
    const elClientes   = crearStatCard(grid, { icono: '👥', label: 'Clientes registrados',  href: 'personal-clientes.html',          linkTxt: 'Ver clientes' });
    const elContratos  = crearStatCard(grid, { icono: '📋', label: 'Contratos activos',     href: 'administracion-contratos.html',   linkTxt: 'Ver contratos' });
    const elHistorial  = crearStatCard(grid, { icono: '🗂',  label: 'Órdenes históricas',   href: 'servicios-historial_ordenes.html', linkTxt: 'Ver historial' });
    const elSeguros    = crearStatCard(grid, { icono: '🛡',  label: 'Seguros vigentes',      href: 'administracion-seguros.html',     linkTxt: 'Ver seguros' });
    const elLocalidades= crearStatCard(grid, { icono: '📍', label: 'Localidades',            href: 'administracion-localidades.html', linkTxt: 'Ver localidades' });

    const [sucursales, empleados, jefes, clientes, contratos, historial, seguros, localidades] = await Promise.all([
        fetchJSON('consulta.php?accion=consulta_sucursales'),
        fetchJSON('consulta.php?accion=consulta_empleados_regulares'),
        fetchJSON('consulta.php?accion=consulta_jefes_sucursal'),
        fetchJSON('consulta.php?accion=consulta_clientes_detalle'),
        fetchJSON('consulta.php?accion=consulta_contratos_detalle'),
        fetchJSON('consulta.php?accion=consulta_historial_ordenes'),
        fetchJSON('consulta.php?accion=consulta_seguro'),
        fetchJSON('consulta.php?accion=consulta_localidad')
    ]);

    setStatVal(elSucursales,  sucursales  ? sucursales.length  : null);
    setStatVal(elEmpleados,   empleados   ? empleados.length   : null);
    setStatVal(elJefes,       jefes       ? jefes.length       : null);
    setStatVal(elClientes,    clientes    ? clientes.length    : null);
    setStatVal(elContratos,   contratos   ? contratos.length   : null);
    setStatVal(elHistorial,   historial   ? historial.length   : null);
    setStatVal(elSeguros,     seguros     ? seguros.length     : null);
    setStatVal(elLocalidades, localidades ? localidades.length : null);
}
