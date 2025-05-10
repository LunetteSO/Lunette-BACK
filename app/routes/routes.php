<?php
// Usar una ruta absoluta para incluir la configuración de la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/Lunette/config/database.php';  // Ruta absoluta a database.php

// Usar una ruta absoluta para incluir el controlador de usuario
require_once $_SERVER['DOCUMENT_ROOT'] . '/Lunette/app/controllers/UserController.php';  // Ruta absoluta a UserController.php


// Aquí agregarías tus rutas para que se ejecuten si los archivos se incluyen correctamente



// Ruta para obtener todos los usuarios
if ($_SERVER['REQUEST_URI'] == '/Lunette/api/users' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $controller = new UserController();
    $controller->index();  // Obtener todos los usuarios
}

// Ruta para obtener un solo usuario por ID
if (preg_match('/\/Lunette\/api\/users\/(\d+)/', $_SERVER['REQUEST_URI'], $matches) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $controller = new UserController();
    $controller->show($matches[1]);  // Obtener un usuario por ID
}

// Ruta para crear un usuario
if ($_SERVER['REQUEST_URI'] == '/Lunette/api/users' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos enviados en el cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    // Comprobar si los datos existen
    $name = $data['name'] ?? '';
    $last_name = $data['last_name'] ?? '';
    $email = $data['email'] ?? '';
    $phone_number = $data['phone_number'] ?? '';

    // Llamamos al método store del controlador
    $controller = new UserController();
    $controller->store($name, $last_name, $email, $phone_number);
}

?>
