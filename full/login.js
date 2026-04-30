/**
login.js — Lógica del formulario de inicio de sesión.

Escucha el submit de #form-login, valida los campos,
y envía las credenciales a login_proceso.php.
Si el servidor responde con estado "ok", redirige al panel principal.

Tipos de acceso:
 cliente: login_proceso.php con accion=login_cliente
 empleado: login_proceso.php con accion=login_empleado
 (este tipo incluye a empleados, jefes de sucursal y jefes generales)
 */
document.getElementById('form-login').addEventListener('submit', async function (e) {
    e.preventDefault();

    const mensajeError = document.getElementById('error-mensaje');
    mensajeError.hidden = true;

    // Leer tipo de usuario (cliente / empleado) desde el select
    const tipo   = this.querySelector('[name="tipo"]').value;
    const nombre = this.querySelector('[name="nombre"]').value.trim();
    const id     = this.querySelector('[name="id_acceso"]').value.trim();

    // Validar que todos los campos estén completos
    if (!tipo || !nombre || !id) {
        mensajeError.hidden      = false;
        mensajeError.textContent = 'Completá todos los campos.';
        return;
    }

    // Construir FormData con los nombres exactos que espera login_proceso.php
    const formData = new FormData();
    if (tipo === 'empleado') {
        formData.append('accion',       'login_empleado');
        formData.append('nombre_emple', nombre);
        formData.append('id_empleado',  id);
    } else {
        formData.append('accion',     'login_cliente');
        formData.append('nombre_cli', nombre);
        formData.append('id_cliente', id);
    }

    try {
        const respuesta = await fetch('login_proceso.php', { method: 'POST', body: formData });
        const resultado = await respuesta.json();

        if (resultado.estado === 'ok') {
            // El rol queda guardado en $_SESSION en login_proceso.php
            window.location.href = 'index.html';
        } else {
            mensajeError.hidden      = false;
            mensajeError.textContent = resultado.mensaje ?? 'Error al iniciar sesión.';
        }

    } catch (error) {
        console.error('Error en el login:', error);
        mensajeError.hidden      = false;
        mensajeError.textContent = 'Error de conexión con el servidor.';
    }
});
