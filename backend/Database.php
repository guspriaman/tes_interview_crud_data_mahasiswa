<?php
class Database {
    private $host = "localhost";
    private $db_name = "mahasiswa_db"; // Ganti dengan nama database Anda
    private $username = "root"; // Sesuaikan dengan user database Anda
    private $password = ""; // Sesuaikan dengan password database Anda
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Koneksi database gagal: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
