document.getElementById('form-registro').addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const mensajeExito = document.getElementById('registro-exitoso');

    mensajeExito.hidden = true;

    try {
        formData.append('accion', 'insert_cliente');

        const respuesta = await fetch('procesar_registro.php', {
            method: 'POST',
            body: formData
        });

        const resultado = await respuesta.json();
      
    } catch (error) {
        console.error("Error al registrar:", error);
        alert("Ocurrió un error en la comunicación con el servidor.");
    }
});
