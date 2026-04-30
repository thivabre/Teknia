/**
signup.js — Lógica del formulario de creación de cuenta de cliente.

Escucha el submit de #form-registro, recopila los datos del cliente
y los envía a procesar_registro.php con accion=insert_cliente.

Si el registro es exitoso, el servidor devuelve el ID asignado al cliente,
que funciona como su "contraseña" para iniciar sesión (junto a su nombre).
 */
document.getElementById('form-registro').addEventListener('submit', async function (e) {
    e.preventDefault();

    const mensajeExito = document.getElementById('registro-exitoso');
    const mensajeError = document.getElementById('error-mensaje');

    // Ocultar mensajes previos
    mensajeExito.hidden = true;
    if (mensajeError) mensajeError.hidden = true;

    // Serializar todos los campos del formulario
    const formData = new FormData(this);
    formData.append('accion', 'insert_cliente'); // Acción esperada por el PHP

    try {
        const respuesta = await fetch('procesar_registro.php', { method: 'POST', body: formData });
        const resultado = await respuesta.json();

        if (resultado.estado === 'ok') {
            // Mostrar el ID de cliente: el usuario lo necesita para hacer login
            mensajeExito.hidden    = false;
            mensajeExito.innerHTML = `
                ¡Registro exitoso! Tu número de cliente es
                <strong>${resultado.id_cliente}</strong>.
                Guardalo: lo necesitás junto a tu nombre para iniciar sesión.
            `;
            this.reset(); // Limpiar el formulario
        } else {
            if (mensajeError) {
                mensajeError.hidden      = false;
                mensajeError.textContent = resultado.mensaje ?? 'Error al registrarse.';
            } else {
                alert(resultado.mensaje ?? 'Error al registrarse.');
            }
        }

    } catch (error) {
        console.error('Error al registrar:', error);
        const msg = 'Ocurrió un error en la comunicación con el servidor.';
        if (mensajeError) {
            mensajeError.hidden      = false;
            mensajeError.textContent = msg;
        } else {
            alert(msg);
        }
    }
});
