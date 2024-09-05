<?php
header('Content-Type: application/json');
include '../config/db.php';

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_user($id);
        } else {
            get_users();
        }
        break;

    case 'POST':
        create_user();
        break;

    case 'PUT':
        $id = intval($_GET["id"]);
        update_user($id);
        break;

    case 'DELETE':
        $id = intval($_GET["id"]);
        delete_user($id);
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_users() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM miembros");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users);
}

function get_user($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM miembros WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($user);
}

function create_user() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"));
    $stmt = $pdo->prepare("INSERT INTO miembros (name, telefono, email) VALUES (?, ?, ?)");
    $stmt->execute([$data->name, $data->telefono, $data->email]);
    echo json_encode(["message" => "User created successfully"]);
}

function update_user($id) {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"));
    $stmt = $pdo->prepare("UPDATE miembros SET name = ?, telefono = ?, email= ? WHERE id = ?");
    $stmt->execute([$data->name, $data->telefono, $data->email, $id]);
    echo json_encode(["message" => "User updated successfully"]);
}

function delete_user($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM miembros WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode(["message" => "User deleted successfully"]);
}
?>