$(document).ready(function() {  
    $("#formularioVuelo").submit(function(event) {  
      event.preventDefault();  
  
      const origen = $("#origenVuelo").val().trim();  
      const destino = $("#destinoVuelo").val().trim();  
      const fecha = $("#fechaVuelo").val();  
      const plazas = $("#plazasVuelo").val();  
      const precio = $("#precioVuelo").val();  
  
      // Validación de datos  
      if (!origen) {  
        alert("Debe ingresar el origen del vuelo.");  
        $("#origenVuelo").focus();  
        return;  
      }  
  
      if (!destino) {  
        alert("Debe ingresar el destino del vuelo.");  
        $("#destinoVuelo").focus();  
        return;  
      }  
  
      if (!fecha) {  
        alert("Debe ingresar la fecha del vuelo.");  
        $("#fechaVuelo").focus();  
        return;  
      }  
  
      if (!plazas || isNaN(plazas) || plazas <= 0) {  
        alert("Debe ingresar un número válido de plazas disponibles.");  
        $("#plazasVuelo").focus();  
        return;  
      }  
  
      if (!precio || isNaN(precio) || precio < 0) {  
        alert("Debe ingresar un precio válido para el vuelo.");  
        $("#precioVuelo").focus();  
        return;  
      }  
  
      // Mostrar feedback de envío  
      $("#feedback").show();  
  
      // Enviar datos al script PHP  
      const datos = {  
        origen,  
        destino,  
        fecha,  
        plazas,  
        precio  
      };  
  
      $.ajax({  
        type: "POST",  
        url: "registrar_vuelo.php",  
        data: datos,  
        success: function(respuesta) {  
          $("#feedback").hide();  
          if (respuesta === "OK") {  
            alert("Vuelo registrado exitosamente.");  
            $("#formularioVuelo")[0].reset(); // Limpiar el formulario  
          } else {  
            alert("Error al registrar el vuelo: " + respuesta);  
          }  
        },  
        error: function() {  
          $("#feedback").hide();  
          alert("Error de comunicación con el servidor.");  
        }  
      });  
    });  
  });