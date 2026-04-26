document.getElementById('form-registro').addEventListener('submit', async function (e) {
    e.preventDefault();

    const mensajeExito = document.getElementById('registro-exitoso');
    const mensajeError = document.getElementById('error-mensaje');

    mensajeExito.hidden = true;
    if (mensajeError) mensajeError.hidden = true;

    const formData = new FormData(this);
    formData.append('accion', 'insert_cliente');

    try {
        const respuesta = await fetch('procesar_registro.php', {
            method: 'POST',
            body: formData
        });

        const resultado = await respuesta.json();

        if (resultado.estado === 'ok') {
            // Mostrar el ID asignado: es la "contraseña" para iniciar sesión
            mensajeExito.hidden = false;
            mensajeExito.innerHTML = `
                ¡Registro exitoso! Tu número de cliente es 
                <strong>${resultado.id_cliente}</strong>. 
                Guardalo: lo necesitás junto a tu nombre para iniciar sesión.
            `;
            this.reset();
        } else {
            if (mensajeError) {
                mensajeError.hidden = false;
                mensajeError.textContent = resultado.mensaje ?? 'Error al registrarse.';
            } else {
                alert(resultado.mensaje ?? 'Error al registrarse.');
            }
        }

    } catch (error) {
        console.error('Error al registrar:', error);
        const msg = 'Ocurrió un error en la comunicación con el servidor.';
        if (mensajeError) {
            mensajeError.hidden = false;
            mensajeError.textContent = msg;
        } else {
            alert(msg);
        }
    }
});
