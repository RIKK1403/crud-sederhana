<!DOCTYPE html>
<html>

<head>
    <title>Form Pembokingan</title>
    <link rel='icon' href='../img/foto1.jpeg'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php
        // Include file koneksi, untuk koneksikan ke database
        include "../koneksi.php";

        // Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Check if form is submitted via POST method
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $judul = input($_POST["judul"]);
            $deskripsi = input($_POST["deskripsi"]);
            $gambar = '';

            // Handle file upload
            if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
                $target_dir = "../img";
                $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                    $gambar = $target_file; // Save the file path in the database
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

            // Use prepared statement to prevent SQL injection
            if (!empty($judul) && !empty($deskripsi) && !empty($gambar)) {
                $stmt = $kon->prepare("INSERT INTO artikel (judul, deskripsi, gambar) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $judul, $deskripsi, $gambar);
                $stmt->execute();
                $stmt->close();
            }
        }
        ?>

        <h2>Input Data ARTIKEL</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />
            </div>
            <div class="form-group">
                <label>Judul:</label>
                <input type="text" name="judul" class="form-control" placeholder="Judul" required />
            </div>
            <div class="form-group">
                <label>Deskripsi:</label>
                <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required />
            </div>
            <div class="form-group">
                <label>Gambar:</label>
                <input type="file" name="gambar" class="form-control" required />
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>
</body>

</html>
