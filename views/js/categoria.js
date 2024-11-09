// Editar categoria
$(".tablas").on("click", ".btnEditarCategoria", function () {
  var idCategoria = $(this).attr("idCategoria"); // Asegúrate de que el botón tiene este atributo
  var datos = new FormData();
  datos.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/categoria.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      // Verificar si la respuesta tiene datos
      if (respuesta) {
        $("#editarCategoria").val(respuesta["categoria"]); // Asigna el nombre de la categoría al input
        $("#idCategoria").val(respuesta["id"]); // Asigna el ID de la categoría al input oculto
        $("#editarFecha").val(respuesta["fecha"]); // Asigna la fecha de la categoría al input
        $("#editarEstado").val(respuesta["estado"]); // Asigna el estado de la categoría al input
      } else {
        // Si no se recibió respuesta válida
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "No se encontró la categoría.",
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      // Manejo de errores en la solicitud
      Swal.fire({
        icon: "error",
        title: "Error en la solicitud",
        text: "No se pudo completar la operación. Inténtalo de nuevo.",
      });
    },
  });
});

