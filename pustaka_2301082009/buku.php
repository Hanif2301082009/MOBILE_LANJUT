<?php
require 'config.php';

// Set headers to allow API access from outside
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$method = $_SERVER['REQUEST_METHOD'];
$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
$request = explode('/', trim($path_info, '/'));
$id = isset($request[1]) ? (int)$request[1] : null;

switch ($method) {
    case 'GET':
        if ($id) {
            // Get book by ID
            $stmt = $pdo->prepare("SELECT * FROM buku WHERE id = ?");
            $stmt->execute([$id]);
            $book = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($book) {
                echo json_encode($book);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Book not found"]);
            }
        } else {
            // Get all books
            $stmt = $pdo->query("SELECT * FROM buku");
            $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($books);
        }
        break;

    case 'POST':
        // Create new book
        $data = json_decode(file_get_contents("php://input"), true);

        if (!empty($data['kode_buku']) && !empty($data['judul']) && !empty($data['pengarang']) && 
            !empty($data['penerbit']) && !empty($data['tahun_terbit'])) {
            
            $stmt = $pdo->prepare("INSERT INTO buku (kode_buku, judul, pengarang, penerbit, tahun_terbit) 
                                  VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $data['kode_buku'],
                $data['judul'],
                $data['pengarang'],
                $data['penerbit'],
                $data['tahun_terbit']
            ]);
            echo json_encode(["message" => "Book created", "id" => $pdo->lastInsertId()]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Invalid data"]);
        }
        break;

    case 'PUT':
        // Update book by ID
        if ($id) {
            $data = json_decode(file_get_contents("php://input"), true);

            $stmt = $pdo->prepare("SELECT * FROM buku WHERE id = ?");
            $stmt->execute([$id]);
            $book = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($book) {
                $kode_buku = $data['kode_buku'] ?? $book['kode_buku'];
                $judul = $data['judul'] ?? $book['judul'];
                $pengarang = $data['pengarang'] ?? $book['pengarang'];
                $penerbit = $data['penerbit'] ?? $book['penerbit'];
                $tahun_terbit = $data['tahun_terbit'] ?? $book['tahun_terbit'];

                $stmt = $pdo->prepare("UPDATE buku SET kode_buku = ?, judul = ?, pengarang = ?, 
                                     penerbit = ?, tahun_terbit = ? WHERE id = ?");
                $stmt->execute([$kode_buku, $judul, $pengarang, $penerbit, $tahun_terbit, $id]);
                echo json_encode(["message" => "Book updated"]);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Book not found"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID not provided"]);
        }
        break;

    case 'DELETE':
        // Delete book by ID
        if ($id) {
            $stmt = $pdo->prepare("SELECT * FROM buku WHERE id = ?");
            $stmt->execute([$id]);
            $book = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($book) {
                $stmt = $pdo->prepare("DELETE FROM buku WHERE id = ?");
                $stmt->execute([$id]);
                echo json_encode(["message" => "Book deleted"]);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Book not found"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID not provided"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>