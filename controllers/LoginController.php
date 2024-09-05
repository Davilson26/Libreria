<?php
header('Content-Type: application/json');
include '../config/db.php';

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'POST':
        validate_login();
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function validate_login() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"));
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE correo = ?");
    $stmt->execute([$data->correo]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo(password_hash($data->password, PASSWORD_BCRYPT));
    // Verificar si el usuario existe y la contraseña es correcta
    if ($user && password_verify($data->password, $user['password'])) {
        session_start();
        // Generar la sesión
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['correo'] = $user['correo'];

        echo json_encode(["message" => "Puedes acceder", "status"=>200]);
    } else {
        // Respuesta de error si las credenciales no son válidas
        echo json_encode(["message" => "Correo o contraseña incorrectos", "status"=>401]);
        http_response_code(401); // Código de estado 401 para indicar no autorizado
    }
}

?>