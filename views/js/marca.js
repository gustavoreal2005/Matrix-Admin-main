// Editar marca
$(".tablas").on("click", ".btnEditarMarca", function() {
    var idMarca = $(this).attr("idMarca"); // Asegúrate de que el botón tiene el atributo "idMarca"
    var datos = new FormData();
    datos.append("idMarca", idMarca);

    $.ajax({
        url: "ajax/marca.ajax.php", // URL para el archivo de manejo de marcas
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // Verificar si la respuesta tiene datos
            if (respuesta) {
                $("#editarMarca").val(respuesta["nombre"]); // Asigna el nombre de la marca al input
                $("#idMarca").val(respuesta["id"]); // Asigna el ID de la marca al input oculto
                $("#estadoMarca").val(respuesta["estado"]); // Asigna el estado de la marca al select
            } else {
                // Si no se recibe una respuesta válida
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se encontró la marca.'
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Manejo de errores en la solicitud
            Swal.fire({
                icon: 'error',
                title: 'Error en la solicitud',
                text: 'No se pudo completar la operación. Inténtalo de nuevo.'
            });
        }
    });
});
