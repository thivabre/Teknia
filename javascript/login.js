document.getElementById('form-login').addEventListener('submit', async function (e) {
    e.preventDefault();

    const mensajeError = document.getElementById('error-mensaje');
    mensajeError.hidden = true;

    // Leer el tipo de usuario seleccionado en el formulario
    // El <select> o <input radio> debe tener name="tipo" y valores "empleado" | "cliente"
    const tipo   = this.querySelector('[name="tipo"]').value;
    const nombre = this.querySelector('[name="nombre"]').value.trim();
    const id     = this.querySelector('[name="id_acceso"]').value.trim();

    if (!tipo || !nombre || !id) {
        mensajeError.hidden = false;
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
        formData.append('accion',      'login_cliente');
        formData.append('nombre_cli',  nombre);
        formData.append('id_cliente',  id);
    }

    try {
        const respuesta = await fetch('login_proceso.php', {
            method: 'POST',
            body: formData
        });

        const resultado = await respuesta.json();

        if (resultado.estado === 'ok') {
            // El rol quedó guardado en $_SESSION dentro de login_proceso.php
            // Redirigir al panel principal
            window.location.href = 'index.html';
        } else {
            mensajeError.hidden = false;
            mensajeError.textContent = resultado.mensaje ?? 'Error al iniciar sesión.';
        }

    } catch (error) {
        console.error('Error en el login:', error);
        mensajeError.hidden = false;
        mensajeError.textContent = 'Error de conexión con el servidor.';
    }
});
