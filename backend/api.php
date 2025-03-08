<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'Database.php';

$database = new Database();
$conn = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $conn->prepare("SELECT * FROM mahasiswa");
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data['nama']) && !empty($data['nim']) && !empty($data['jurusan'])) {
            $stmt = $conn->prepare("INSERT INTO mahasiswa (nama, nim, jurusan) VALUES (:nama, :nim, :jurusan)");
            $stmt->bindParam(':nama', $data['nama']);
            $stmt->bindParam(':nim', $data['nim']);
            $stmt->bindParam(':jurusan', $data['jurusan']);
            if ($stmt->execute()) {
                echo json_encode(["message" => "Mahasiswa berhasil ditambahkan"]);
            } else {
                echo json_encode(["message" => "Gagal menambahkan mahasiswa"]);
            }
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data['id']) && !empty($data['nama']) && !empty($data['nim']) && !empty($data['jurusan'])) {
            $stmt = $conn->prepare("UPDATE mahasiswa SET nama = :nama, nim = :nim, jurusan = :jurusan WHERE id = :id");
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':nama', $data['nama']);
            $stmt->bindParam(':nim', $data['nim']);
            $stmt->bindParam(':jurusan', $data['jurusan']);
            if ($stmt->execute()) {
                echo json_encode(["message" => "Mahasiswa berhasil diperbarui"]);
            } else {
                echo json_encode(["message" => "Gagal memperbarui mahasiswa"]);
            }
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data['id'])) {
            $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = :id");
            $stmt->bindParam(':id', $data['id']);
            if ($stmt->execute()) {
                echo json_encode(["message" => "Mahasiswa berhasil dihapus"]);
            } else {
                echo json_encode(["message" => "Gagal menghapus mahasiswa"]);
            }
        }
        break;
}
?>
