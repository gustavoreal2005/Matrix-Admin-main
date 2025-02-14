/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/
$(".nuevaImagen").change(function(){



    var imagen = this.files[0];
  
    
  
    /*=============================================
  
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  
    =============================================*/
  
  
  
    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  
  
  
      $(".nuevaImagen").val("");
  
  
  
       swal({
  
         title: "Error al subir la imagen",
  
         text: "¡La imagen debe estar en formato JPG o PNG!",
  
         type: "error",
  
         confirmButtonText: "¡Cerrar!"
  
        });
  
  
  
    }else if(imagen["size"] > 2000000){
  
  
  
      $(".nuevaImagen").val("");
  
  
  
       swal({
  
         title: "Error al subir la imagen",
  
         text: "¡La imagen no debe pesar más de 2MB!",
  
         type: "error",
  
         confirmButtonText: "¡Cerrar!"
  
        });
  
  
  
    }else{
  
  
  
      var datosImagen = new FileReader;
  
      datosImagen.readAsDataURL(imagen);
  
  
  
      $(datosImagen).on("load", function(event){
  
  
  
        var rutaImagen = event.target.result;
  
  
  
        $(".previsualizar").attr("src", rutaImagen);
  
  
  
      })
  
  
  
    }
  
  })

// Capturando la categoria para asignar código
$("#nuevaCategoria").change(function(){
  var idCategoria = $(this).val();
  var datos = new FormData();
  datos.append("idCategoria",idCategoria);
  $.ajax({
    url: "ajax/producto.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
      if(!respuesta){
        var nuevoCodigo = idCategoria+"01";
        $("#nuevoCodigo").val(nuevoCodigo);
      }else{
        var nuevoCodigo = Number(respuesta["codigo"]) + 1;
        $("#nuevoCodigo").val(nuevoCodigo);
      }
    }
  })
})

// agregando precio de venta
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){
  if($(".porcentaje").prop("checked")){
    var valorPorcentaje = $(".nuevoPorcentaje").val();
    var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());
    var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly",true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly",true);

  }
})

// cambio de porcentaje
$(".nuevoPorcentaje").change(function(){
  if($(".porcentaje").prop("checked")){
    var valorPorcentaje = $(this).val();
    var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());
    var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly",true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly",true);

  }
})

$(".porcentaje").on("ifUnchecked", function(){
  $("#nuevoPrecioVenta").prop("readonly",false);
  $("#editarPrecioVenta").prop("readonly",false);
})
$(".porcentaje").on("ifUnchecked", function(){
  $("#nuevoPrecioVenta").prop("readonly",true);
  $("#editarPrecioVenta").prop("readonly",true);
})

// DataTable JQuery Productos
$('.tablaProductos').DataTable({
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "languaje": {
    "sProcessing":      "Procesando...",
        "sLengthMenu":      "Mostrar_MENU_registros",
        "sZeroRecords":     "No se encontraron resultados",
        "sEmptyTable":       "Ningún dato disponible en esta tabla",
        "sInfo":            "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":       "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":    "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":     "",
        "sSearch":          "Buscar:",
        "sUrl":             "",
        "sInfoThousands":   ",",
        "sLoadingRecords":  "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":   ": Activar para ordenar la columna de manera ascedente",
            "sSortDescending":  ": Activar para ordenar la columna de manera descendente"
        }
  }
});