<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'Database.php';

$database = new Database();
$conn = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $conn->prepare("SELECT * FROM mahasiswa_baru");
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data['nama']) && !empty($data['nim']) && !empty($data['jurusan']) && !empty($data['jenis_kelamin'])) {
            $stmt = $conn->prepare("INSERT INTO mahasiswa_baru (nama, nim, jurusan, jenis_kelamin) VALUES (:nama, :nim, :jurusan, :jenis_kelamin)");
            $stmt->bindParam(':nama', $data['nama']);
            $stmt->bindParam(':nim', $data['nim']);
            $stmt->bindParam(':jurusan', $data['jurusan']);
            $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
            if ($stmt->execute()) {
                echo json_encode(["message" => "Data berhasil ditambahkan"]);
            } else {
                echo json_encode(["message" => "Gagal menambahkan data"]);
            }
        } else {
            echo json_encode(["message" => "Semua field harus diisi"]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data['id']) && !empty($data['nama']) && !empty($data['nim']) && !empty($data['jurusan']) && !empty($data['jenis_kelamin'])) {
            $stmt = $conn->prepare("UPDATE mahasiswa_baru SET nama = :nama, nim = :nim, jurusan = :jurusan, jenis_kelamin = :jenis_kelamin WHERE id = :id");
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':nama', $data['nama']);
            $stmt->bindParam(':nim', $data['nim']);
            $stmt->bindParam(':jurusan', $data['jurusan']);
            $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
            if ($stmt->execute()) {
                echo json_encode(["message" => "Data berhasil diperbarui"]);
            } else {
                echo json_encode(["message" => "Gagal memperbarui data"]);
            }
        } else {
            echo json_encode(["message" => "Semua field harus diisi"]);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data['id'])) {
            $stmt = $conn->prepare("DELETE FROM mahasiswa_baru WHERE id = :id");
            $stmt->bindParam(':id', $data['id']);
            if ($stmt->execute()) {
                echo json_encode(["message" => "Data berhasil dihapus"]);
            } else {
                echo json_encode(["message" => "Gagal menghapus data"]);
            }
        } else {
            echo json_encode(["message" => "ID diperlukan"]);
        }
        break;

    default:
        echo json_encode(["message" => "Metode tidak didukung"]);
}
?>
