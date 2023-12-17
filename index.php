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
            <h1>Form Mahasiswa</h1>
            <form method="post">
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="nim">NIM:</label>
                    <input type="text" id="nim" name="nim" required>
                </div>

                <div class="form-group">
                    <label for="religion">Agama:</label>
                    <input type="text" id="religion" name="religion" required>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin:</label>
                    <div class="gender-options">
                        <input type="radio" id="Laki-laki" name="gender" value="Laki-laki" required>
                        <label for="Laki-laki">Laki-laki</label>

                        <input type="radio" id="Perempuan" name="gender" value="Perempuan" required>
                        <label for="Perempuan">Perempuan</label>
                    </div>
                </div>

                <div class="btn">
                    <input class="button" type="submit" value="Submit">
                </div>
            </form>
        </section>

        <section class="db">
            <h1>Table Database</h1>
            <table id="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Agama</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    include "database.php";
                    
                    $db = new Database("localhost", "root", "121140227_Faisal", "projectpemweb");
                    
                    $list = $db->show();
                    
                    foreach ($list as $row):
                        ?>
                        <tr>
                            <td><?= $row['name']?></td>
                            <td><?= $row['nim']?></td>
                            <td><?= $row['religion']?></td>
                            <td><?= $row['gender']?></td>
                            <td>
                                <a href="#" class="edit-link" data-nim="<?= $row['nim'] ?>">Ubah</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="output">
            <h2>Data User Session</h2>
            <?php
                if (isset($_SESSION['user'])) {
                    echo "Nama: " . $_SESSION['user']['name'] . "<br>";
                    echo "NIM: " . $_SESSION['user']['nim'] . "<br>";
                    echo "Agama: " . $_SESSION['user']['religion'] . "<br>";
                    echo "Gender: " . $_SESSION['user']['gender'] . "<br>";
                } else {
                    echo "Tidak ada data pengguna dalam session";
                }
            ?>
        </section>
    </div>

    <script src="script.js"></script>
    <script src="cookie.js"></script>
</body>
</html>
