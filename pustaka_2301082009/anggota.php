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
            // Get member by ID
            $stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = ?");
            $stmt->execute([$id]);
            $member = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($member) {
                echo json_encode($member);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Member not found"]);
            }
        } else {
            // Get all members
            $stmt = $pdo->query("SELECT * FROM anggota");
            $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($members);
        }
        break;

    case 'POST':
        // Create new member
        $data = json_decode(file_get_contents("php://input"), true);

        if (!empty($data['kode_anggota']) && !empty($data['nama_anggota']) && 
            !empty($data['alamat']) && !empty($data['jenis_kelamin'])) {
            
            // Validate jenis_kelamin only accepts 'L' or 'P'
            if (!in_array($data['jenis_kelamin'], ['L', 'P'])) {
                http_response_code(400);
                echo json_encode(["message" => "Invalid jenis_kelamin. Must be 'L' or 'P'"]);
                break;
            }

            $stmt = $pdo->prepare("INSERT INTO anggota (kode_anggota, nama_anggota, alamat, jenis_kelamin) 
                                  VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $data['kode_anggota'],
                $data['nama_anggota'],
                $data['alamat'],
                $data['jenis_kelamin']
            ]);
            echo json_encode(["message" => "Member created", "id" => $pdo->lastInsertId()]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Invalid data"]);
        }
        break;

    case 'PUT':
        // Update member by ID
        if ($id) {
            $data = json_decode(file_get_contents("php://input"), true);

            $stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = ?");
            $stmt->execute([$id]);
            $member = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($member) {
                $kode_anggota = $data['kode_anggota'] ?? $member['kode_anggota'];
                $nama_anggota = $data['nama_anggota'] ?? $member['nama_anggota'];
                $alamat = $data['alamat'] ?? $member['alamat'];
                $jenis_kelamin = $data['jenis_kelamin'] ?? $member['jenis_kelamin'];

                // Validate jenis_kelamin if it's being updated
                if (isset($data['jenis_kelamin']) && !in_array($data['jenis_kelamin'], ['L', 'P'])) {
                    http_response_code(400);
                    echo json_encode(["message" => "Invalid jenis_kelamin. Must be 'L' or 'P'"]);
                    break;
                }

                $stmt = $pdo->prepare("UPDATE anggota SET kode_anggota = ?, nama_anggota = ?, 
                                     alamat = ?, jenis_kelamin = ? WHERE id = ?");
                $stmt->execute([$kode_anggota, $nama_anggota, $alamat, $jenis_kelamin, $id]);
                echo json_encode(["message" => "Member updated"]);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Member not found"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID not provided"]);
        }
        break;

    case 'DELETE':
        // Delete member by ID
        if ($id) {
            $stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = ?");
            $stmt->execute([$id]);
            $member = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($member) {
                $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = ?");
                $stmt->execute([$id]);
                echo json_encode(["message" => "Member deleted"]);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Member not found"]);
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