<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Project Pemweb</title>
</head>

<body>
    <div class="container">
        <section>
            <h1>Ubah Data Mahasiswa</h1>
            <?php
            include 'database.php';

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nim'])) {
                $nim = $_GET['nim'];
                $db = new Database("localhost", "root", "121140227_Faisal", "projectpemweb");
                $result = $db->getnim($nim);

                if ($result !== false && count($result) > 0) {
                    $data = $result[0];
                    ?>
                    <form method="post">
                        <div class="ex">
                            <label for="name">Nama:</label>
                            <input type="text" value="<?= $data["name"] ?>" name="name" required>
                        </div>

                        <br>

                        <div class="ex">
                            <label for="nim">NIM:</label>
                            <input type="text" value="<?= $data["nim"] ?>" name="nim" required readonly>
                        </div>

                        <br>

                        <div class="ex">
                            <label for="religion">Agama:</label>
                            <input type="text" value="<?= $data["religion"] ?>" name="religion" required>
                        </div>

                        <br>

                        <div class="ex">
                            <label for="gender">Jenis Kelamin:</label>
                            <input type="radio" id="male" name="gender" value="Laki-laki" <?= ($data["gender"] == "Laki-laki") ? "checked" : "" ?>>
                            <label for="male">Laki-laki</label>
                            <input type="radio" id="female" name="gender" value="Perempuan" <?= ($data["gender"] == "Perempuan") ? "checked" : "" ?>>
                            <label for="female">Perempuan</label>
                        </div>

                        <br>
                        <div class="btn">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
            <?php
                }
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
                $religion = isset($_POST['religion']) ? $_POST['religion'] : '';
                $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

                $db = new Database("localhost", "root", "121140227_Faisal", "projectpemweb");

                $saveResult = $db->updateBynim($nim, $name, $religion, $gender);

                if ($saveResult) {
                    echo '<script>alert("Data berhasil diupdate."); window.location.href = "index.php";</script>';
                    exit();
                } else {
                    echo "Gagal mengupdate data.";
                }
                $db->closeConnection();
            }
            ?>
        </section>
    </div>
</body>

</html>
