<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Vuelos</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#formularioVuelo").submit(function(event) {
        event.preventDefault();

        // Validación básica de datos
        if ($("#origenVuelo").val() === "") {
          alert("Debe ingresar el origen del vuelo.");
          return false;
        }

        if ($("#destinoVuelo").val() === "") {
          alert("Debe ingresar el destino del vuelo.");
          return false;
        }

        if ($("#fechaVuelo").val() === "") {
          alert("Debe ingresar la fecha del vuelo.");
          return false;
        }

        if ($("#plazasVuelo").val() === "" || isNaN($("#plazasVuelo").val())) {
          alert("Debe ingresar un número válido de plazas disponibles.");
          return false;
        }

        if ($("#precioVuelo").val() === "" || isNaN($("#precioVuelo").val())) {
          alert("Debe ingresar un precio válido para el vuelo.");
          return false;
        }

        // Enviar datos al script PHP
        var datos = {
          origen: $("#origenVuelo").val(),
          destino: $("#destinoVuelo").val(),
          fecha: $("#fechaVuelo").val(),
          plazas: $("#plazasVuelo").val(),
          precio: $("#precioVuelo").val()
        };

        $.ajax({
          type: "POST",
          url: "registrar_vuelo.php",
          data: datos,
          success: function(respuesta) {
            if (respuesta === "OK") {
              alert("Vuelo registrado exitosamente.");
              $("#formularioVuelo")[0].reset(); // Limpiar formulario
            } else {
              alert("Error al registrar el vuelo: " + respuesta);
            }
          },
          error: function() {
            alert("Error de comunicación con el servidor.");
          }
        });
      });
    });
  </script>
</head>
<body>
<header class="header">
    <img id="header_logo" src="./images/logo.jpg" alt="logo">
    <h1 id="header_titulo">Agencia de viajes</h1>
  </header>   
    <?php

    $servidor = "localhost"; // Reemplazar con su nombre de servidor
    $usuario = "root"; // Reemplazar con su nombre de usuario
    $password = ""; // Reemplazar con su contraseña
    $base_datos = "agenciadeviajes06";

    $conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

    if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
    }

    echo "Conexión exitosa a la base de datos AGENCIA";
    ?>

  <h1>Registro de Vuelos</h1>
  <form id="formularioVuelo" method="post">
    <label for="origenVuelo">Origen:</label>
    <input type="text" id="origenVuelo" name="origen" required><br>

    <label for="destinoVuelo">Destino:</label>
    <input type="text" id="destinoVuelo" name="destino" required><br>

    <label for="fechaVuelo">Fecha:</label>
    <input type="date" id="fechaVuelo" name="fecha" required><br>

    <label for="plazasVuelo">Plazas Disponibles:</label>
    <input type="number" id="plazasVuelo" name="plazas" required><br>

    <label for="precioVuelo">Precio:</label>
    <input type="number" step="0.01" id="precioVuelo" name="precio" required><br>

    <input type="submit" value="Registrar Vuelo">
  </form>
</body>
</html>
