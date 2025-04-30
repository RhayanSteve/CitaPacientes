<?php
$host = "localhost";
$usu = "root";
$pass = "";
$basededatos = "doc_agenda_citas";

$conexion = new mysqli($host, $usu, $pass, $basededatos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// $conexion->set_charset("utf8");
// echo "Conectado";

