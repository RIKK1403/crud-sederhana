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
        //Include file koneksi, untuk koneksikan ke database
        include "../koneksi.php";

        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // $id=htmlspecialchars($_POST["id"]);
            $nama = input($_POST["nama"]);
            $alamat = input($_POST["alamat"]);
            $service_date = input($_POST["service_date"]);
            $no_hp = input($_POST["no_hp"]);
            $jam = input($_POST["jam"]);
            $tanggal_service = input($_POST["service_date"]);  // Tanggal service yang dipilih
            $id_jenis_service = input($_POST["id_jenis_service"]);  // Tanggal service yang dipilih

            // Mengecek apakah tanggal yang dipilih sudah ada di database
            $checkDateQuery = "SELECT * FROM pembokingan WHERE service_date = '$tanggal_service'";
            $checkDateResult = mysqli_query($kon, $checkDateQuery);

            if (mysqli_num_rows($checkDateResult) > 0) {
                // Jika tanggal sudah ada, tampilkan pesan error
                echo "<div class='alert alert-danger'>Tanggal sudah dipilih, silakan pilih tanggal lain.</div>";
            } else {
                // Query untuk memasukkan data ke dalam tabel peserta
                $sql = "INSERT INTO pembokingan (nama, alamat, service_date, no_hp, jam, id_jenis_service) VALUES ('$nama', '$alamat', '$tanggal_service', '$no_hp', '$jam', '$id_jenis_service')";

                // Mengeksekusi/menjalankan query diatas
                $hasil = mysqli_query($kon, $sql);

                // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
                if ($hasil) {
                    header("Location:index.php");
                } else {
                    echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
                }
            }
        }

        // $servicesSql = "SELECT id, nama_service FROM jenis_service";
        // $result = mysqli_query($kon, $servicesSql);


        //     echo '<select name="nama_service">';
        //     if ($result->num_rows > 0) {
        //         while ($row = $result->fetch_assoc()) {
        //             echo '<option value="' . $row["id"] . '">' . $row["nama_service"] . '</option>';
        //         }
        //     } else {
        //         echo '<option>Tidak ada data</option>';
        //     }
        //     echo '</select>';

        //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //         $selected_val = $_POST['dropdown'];  
        //     }
        ?>
        <h2>Input Data Pembokingan</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />
            </div>
            <div class="form-group">
                <label>Jenis Service:</label>
                <select name="id_jenis_service" id="" class="form-control">
                    <?php
                        $servicesSql = "SELECT id, nama_service FROM jenis_service";
                        $result = mysqli_query($kon, $servicesSql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row["id"] . '">' . $row["nama_service"] . '</option>';
                            }
                        } else {
                            echo '<option>Tidak ada data</option>';
                            
                        }
                    ?>
                </select>
                <!-- <input type="text" name="jenis_service" class="form-control" placeholder="service yang di pilih" required /> -->
            </div>
            <div class="form-group">
                <label>Tanggal Service:</label>
                <input type="date" name="service_date" class="form-control" placeholder="tanggal service" required />
            </div>
            <div class="form-group">
                <label>Jam service:</label>
                <input type="time" name="jam" class="form-control" placeholder="jam" required />
            </div>
            <div class="form-group">
                <label>No HP:</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" required />
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan Alamat" required></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-primary">kembali</a>
        </form>
    </div>
</body>

</html>