<?php
session_start(); 

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
    $religion = isset($_POST['religion']) ? $_POST['religion'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    // Simpan data pengguna ke sesi
    $_SESSION['user'] = [
        'name' => $name,
        'nim' => $nim,
        'religion' => $religion,
        'gender' => $gender
    ];

    // Kirim respons JSON berhasil
    $response = ['success' => true, 'message' => 'Data berhasil diterima di PHP.'];
    echo json_encode($response);

    // Dapatkan informasi browser dan alamat IP
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Inisialisasi objek Database
    $db = new Database("localhost", "root", "project", "projectpemweb");

    // Simpan data ke database
    $saveResult = $db->saveToDatabase($name, $nim, $religion, $gender, $browser, $ip_address);

    // Tutup koneksi database
    $db->closeConnection();
} else {
    // Kirim respons JSON gagal jika metode permintaan tidak valid
    $response = ['success' => false, 'message' => 'Metode permintaan tidak valid.'];
    echo json_encode($response);
}
?>
