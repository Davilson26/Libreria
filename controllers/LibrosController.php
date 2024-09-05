<?php
header('Content-Type: application/json');
include '../config/db.php';

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_libro($id);
        } else {
            get_libros();
        }
        break;

    case 'POST':
        create_libro();
        break;

    case 'PUT':
        $id = intval($_GET["id"]);
        update_libro($id);
        break;

    case 'DELETE':
        $id = intval($_GET["id"]);
        delete_libro($id);
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_libros() {
    global $pdo;
    $stmt = $pdo->query("SELECT libros.id as id, libros.titulo as titulo, libros.autor as autor, libros.disponibilidad as disponibilidad, libros.categoria_id as categoria_id, categorias.nombre as nombre FROM libros INNER JOIN categorias on libros.categoria_id = categorias.id");
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($libros);
}

function get_libro($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM libros WHERE id = ?");
    $stmt->execute([$id]);
    $libro = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($libro);
}

function create_libro() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"));
    $stmt = $pdo->prepare("INSERT INTO libros (titulo, autor, disponibilidad, categoria_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$data->titulo, $data->autor, $data->disponibilidad, $data->categoria_id]);
    echo json_encode(["message" => "libro created successfully"]);
}

function update_libro($id) {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"));
    $stmt = $pdo->prepare("UPDATE libros SET titulo = ?,  autor= ?, disponibilidad = ?, categoria_id = ? WHERE id = ?");
    $stmt->execute([$data->titulo, $data->autor, $data->disponibilidad, $data->categoria_id, $id]);
    echo json_encode(["message" => "libro updated successfully"]);
}

function delete_libro($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM libros WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode(["message" => "libro deleted successfully"]);
}
?>