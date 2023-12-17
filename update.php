<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nimToUpdate = isset($_POST['nim']) ? $_POST['nim'] : '';
    $newName = isset($_POST['name']) ? $_POST['name'] : '';
    $newreligion = isset($_POST['religion']) ? $_POST['religion'] : '';
    $newGender = isset($_POST['gender']) ? $_POST['gender'] : '';

    $db = new Database("localhost", "root", "project", "projectpemweb");

    $updateResult = $db->updateBynim($nimToUpdate, $newName, $newreligion, $newGender);

    if ($updateResult) {
        echo "<script>alert('Update berhasil!')</script>";
    } else {
        echo "<script>alert('Update gagal. N\Mohon periksa kembali!')</script>";
    }

    $db->closeConnection();
}
?>
