<?php
// Configuración de la base de datos
$host = "4.206.5.198";   // Dirección IP del servidor de la base de datos
$user = "lunette";       // Usuario de MySQL
$password = "SOLunette"; // Contraseña de MySQL
$dbname = "lunette_db";  // Nombre de la base de datos

try {
    // Establecemos la conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    // Configuramos el manejo de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si hay un error de conexión
    echo "Error de conexión: " . $e->getMessage();
}
?>
