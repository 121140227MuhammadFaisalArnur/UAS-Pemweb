<?php
include 'config.php';
class Database {
    private $conn;

    // Konstruktor untuk menginisialisasi koneksi ke database
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }

    // Metode untuk menyimpan data ke database
    public function saveToDatabase($name, $nim, $religion, $gender, $browser, $ip_address) {
        try {
            $sql = "INSERT INTO murid (name, nim, religion, gender, browser, ip_address) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $nim, PDO::PARAM_STR);
            $stmt->bindParam(3, $religion, PDO::PARAM_STR);
            $stmt->bindParam(4, $gender, PDO::PARAM_STR);
            $stmt->bindParam(5, $browser, PDO::PARAM_STR);
            $stmt->bindParam(6, $ip_address, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    // Metode untuk memperbarui data berdasarkan nim
    public function updateBynim($nim, $newName, $newreligion, $newGender) {
        try {
            $sql = "UPDATE murid SET name = :newName, religion = :newreligion, gender = :newGender WHERE nim = :nim";
            $stmt = $this->conn->prepare($sql);
        
            $stmt->bindParam(':newName', $newName, PDO::PARAM_STR);
            $stmt->bindParam(':newreligion', $newreligion, PDO::PARAM_STR);
            $stmt->bindParam(':newGender', $newGender, PDO::PARAM_STR);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
        
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error updating data: " . $e->getMessage());
        }
    }

    // Metode untuk mendapatkan data berdasarkan nim
    public function getnim($nim) {
        try {
            $sql = "SELECT * FROM murid WHERE nim = ?";
            $stmt = $this->conn->prepare($sql);
    
            $stmt->bindParam(1, $nim, PDO::PARAM_STR);
    
            $stmt->execute();
    
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
    // Metode untuk menampilkan semua data dari tabel murid
    public function show(){
        $sql = "SELECT name, nim, religion, gender FROM murid";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Metode untuk menutup koneksi ke database
    public function closeConnection() {
        $this->conn = null;
    }
}

?>
