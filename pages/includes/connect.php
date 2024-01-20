<?php
// Configuración de la base de datos
$dbaddress = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$dbname = 'bmbshoes';

// Crear una nueva conexión a la base de datos
$db = new mysqli($dbaddress, $dbuser, $dbpassword, $dbname);

// Verificar si la conexión tiene errores
if ($db->connect_error) {
    echo "Conexión fallida: " . $db->connect_errno;
}
