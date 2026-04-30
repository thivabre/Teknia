/**
 * sucursales-creacion.js — Formulario de creación de nueva sucursal.
 *
 * Usa tablas.js para la verificación de sesión.
 * Solo accesible para jefe_general (controlado por data-rol en el HTML).
 *
 * El formulario envía los datos a insercion.php con accion=crear_sucursal_nueva.
 * El PHP crea la sucursal junto con sus inventarios (repuestos y productos) e impuestos.
 */
(function () {
    document.addEventListener('DOMContentLoaded', async function () {
        const sesion = await verificarSesion();
        if (!sesion) return;

        // ── 1. Poblar select de tipos de impuesto ──────────────────
        try {
            const res      = await fetch('consulta.php?accion=consulta_tipo_impuesto');
            const impuestos = await res.json();
            const sel       = document.getElementById('sel-tipo-imp');
            sel.innerHTML  = '<option value="">Seleccione tipo de impuesto…</option>';
            impuestos.forEach(imp => {
                const opt = document.createElement('option');
                opt.value       = imp.tipo_imp;
                opt.textContent = imp.tipo_imp;
                sel.appendChild(opt);
            });
        } catch (e) { console.error('Error cargando impuestos:', e); }

        // ── 2. Botón de creación de sucursal ───────────────────────
        document.getElementById('btn-crear-sucursal').addEventListener('click', async function () {
            const msgEl    = document.getElementById('msg-sucursal');
            const mostrarMsg = (texto, tipo) => {
                msgEl.textContent    = texto;
                msgEl.style.display  = 'block';
                msgEl.style.background = tipo === 'ok' ? '#d1fae5' : '#fee2e2';
                msgEl.style.color      = tipo === 'ok' ? '#065f46' : '#991b1b';
            };

            // Recolectar campos
            const pais      = document.getElementById('suc-pais').value.trim();
            const provincia = document.getElementById('suc-provincia').value.trim();
            const ciudad    = document.getElementById('suc-ciudad').value.trim();
            const barrio    = document.getElementById('suc-barrio').value.trim();
            const calle     = document.getElementById('suc-calle').value.trim();
            const altura    = parseInt(document.getElementById('suc-altura').value) || 0;
            const codPostal = parseInt(document.getElementById('suc-cod-postal').value) || 0;
            const tipoImp   = document.getElementById('sel-tipo-imp').value;

            // Validaciones campo por campo con mensajes específicos
            if (!pais)      { mostrarMsg('El campo País es requerido.', 'error'); return; }
            if (!provincia) { mostrarMsg('El campo Provincia es requerido.', 'error'); return; }
            if (!ciudad)    { mostrarMsg('El campo Ciudad es requerido.', 'error'); return; }
            if (!barrio)    { mostrarMsg('El campo Barrio es requerido.', 'error'); return; }
            if (!calle)     { mostrarMsg('El campo Calle es requerido.', 'error'); return; }
            if (!altura)    { mostrarMsg('Ingrese la altura de la dirección.', 'error'); return; }
            if (!codPostal) { mostrarMsg('Ingrese el código postal.', 'error'); return; }
            if (!tipoImp)   { mostrarMsg('Seleccione el tipo de impuesto.', 'error'); return; }

            const fd = new FormData();
            fd.append('accion',              'crear_sucursal_nueva');
            fd.append('pais',                pais);
            fd.append('provincia',           provincia);
            fd.append('ciudad',              ciudad);
            fd.append('barrio',              barrio);
            fd.append('calle_suc',           calle);
            fd.append('altura_suc',          altura);
            fd.append('cod_postal_suc',      codPostal);
            fd.append('tipo_imp',            tipoImp);
            fd.append('cant_empleados',      0);      // Empieza sin empleados
            fd.append('reparaciones_hechas', 0);      // Empieza sin reparaciones

            this.disabled    = true;
            this.textContent = 'Creando…';

            try {
                const res   = await fetch('insercion.php', { method: 'POST', body: fd });
                const datos = await res.json();

                if (datos.estado === 'ok') {
                    mostrarMsg(`✔ Sucursal #${datos.id_sucursal} creada correctamente.`, 'ok');
                    // Limpiar todos los campos
                    ['suc-pais','suc-provincia','suc-ciudad','suc-barrio',
                     'suc-calle','suc-altura','suc-cod-postal'].forEach(id => {
                        document.getElementById(id).value = '';
                    });
                    document.getElementById('sel-tipo-imp').value = '';
                } else {
                    mostrarMsg('Error: ' + datos.mensaje, 'error');
                }
            } catch (err) {
                mostrarMsg('Error de conexión.', 'error');
                console.error(err);
            } finally {
                this.disabled    = false;
                this.textContent = 'Crear sucursal';
            }
        });
    });
})();
