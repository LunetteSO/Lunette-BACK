<?php


class User {
    // Propiedades del modelo (columnas de la tabla)
    public $user_id;
    public $name;
    public $last_name;
    public $email;
    public $phone_number;

    // Método para obtener todos los usuarios

    public static function all() {
        global $pdo;  // Usamos la conexión a la base de datos definida en database.php

        // Realizamos la consulta SQL
        $query = "SELECT * FROM user";  // Cambia "user" por el naombre real de tu tabla
        $stmt = $pdo->query($query);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtener todos los usuarios como un array asociativo
        
        return $users;  // Retorna los usuarios
    }

    // Método para obtener un solo usuario por ID
    public static function find($user_id) {
        global $pdo;

        $query = "SELECT * FROM user WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Retorna un solo usuario
    }

    // Método para crear un nuevo usuario
    public static function create($name, $last_name, $email, $phone_number) {
        global $pdo;

        $query = "INSERT INTO user (name, last_name, email, phone_number) 
                  VALUES (:name, :last_name, :email, :phone_number)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $stmt->execute();
        
        return $pdo->lastInsertId();  // Retorna el ID del nuevo usuario insertado
    }

    // Método para actualizar un usuario
    public static function update($user_id, $name, $last_name, $email, $phone_number) {
        global $pdo;

        $query = "UPDATE user 
                  SET name = :name, last_name = :last_name, email = :email, phone_number = :phone_number 
                  WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->rowCount();  // Retorna el número de filas afectadas
    }

    // Método para eliminar un usuario
    public static function delete($user_id) {
        global $pdo;

        $query = "DELETE FROM user WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->rowCount();  // Retorna el número de filas afectadas
    }
}
?>
