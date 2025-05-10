<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Lunette/app/models/User.php';  // Incluir el modelo de usuario

class UserController {

    // Método para obtener todos los usuarios
    public function index() {
        // Usamos el modelo para obtener todos los usuarios
        $users = User::all();
        echo json_encode($users);  // Respondemos con los datos de los usuarios en formato JSON
    }

    // Método para obtener un solo usuario por ID
    public function show($user_id) {
        // Usamos el modelo para obtener el usuario por su ID
        $user = User::find($user_id);
        echo json_encode($user);  // Respondemos con el dato del usuario en formato JSON
    }

    // Método para crear un nuevo usuario
    public function store($name, $last_name, $email, $phone_number) {
        // Verificar qué datos están llegando
        if (empty($name) || empty($last_name) || empty($email) || empty($phone_number)) {
            echo "Error: Datos incompletos";
        } else {
            var_dump($name, $last_name, $email, $phone_number); // Para depurar
        }

        // Usamos el modelo para crear el nuevo usuario
        $user_id = User::create($name, $last_name, $email, $phone_number);
        echo json_encode(['user_id' => $user_id]);  // Respondemos con el ID del nuevo usuario creado
    }


    // Método para actualizar un usuario
    public function update($user_id, $name, $last_name, $email, $phone_number) {
        // Usamos el modelo para actualizar los datos del usuario
        $rows_affected = User::update($user_id, $name, $last_name, $email, $phone_number);
        echo json_encode(['rows_affected' => $rows_affected]);  // Respondemos con el número de filas afectadas
    }

    // Método para eliminar un usuario
    public function destroy($user_id) {
        // Usamos el modelo para eliminar el usuario
        $rows_affected = User::delete($user_id);
        echo json_encode(['rows_affected' => $rows_affected]);  // Respondemos con el número de filas afectadas
    }
}
?>
