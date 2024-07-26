<?php

$servidor = "localhost"; // Reemplazar con su nombre de servidor
$usuario = "root"; // Reemplazar con su nombre de usuario
$password = ""; // Reemplazar con su contraseña
$base_datos = "agenviadeviajes06";

$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

if (!$conexion) {
  die("Error de conexión: " . mysqli_connect_error());
}

echo "Conexión exitosa a la base de datos AGENCIA";


