document.getElementById('form-login').addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const mensajeError = document.getElementById('error-mensaje');

    // Asegurarse de ocultarlo cada vez que se intenta un nuevo submit
    mensajeError.hidden = true;

    try {
        const respuesta = await fetch('login_proceso.php', {
            method: 'POST',
            body: formData
        });

        const resultado = await respuesta.json();

        if (resultado.estado === 'ok') {
            alert(`Bienvenido ${resultado.nombre}`);
            window.location.href = "index.html";
        } else {
            // Mostrar el mensaje quitando el estado hidden
            mensajeError.hidden = false;
            mensajeError.textContent = resultado.mensaje;
        }
    } catch (error) {
        console.error("Error en el login:", error);
        mensajeError.hidden = false;
        mensajeError.textContent = "Error de conexión con el servidor.";
    }
});
