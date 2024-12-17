<!DOCTYPE html>
<html>
<head>
    <title>Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "../koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_peserta
    if (isset($_GET['id'])) {
        $id=input($_GET["id"]);

        $sql="select * from pembokingan where id=$id";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id=htmlspecialchars($_POST["id"]);
        $nama=input($_POST["nama"]);
        $alamat=input($_POST["alamat"]);
        $service_date=input($_POST["service_date"]);
        $no_hp=input($_POST["no_hp"]);
        $jam=input($_POST["jam"]);

        //Query update data pada tabel anggota
        $sql="update pembokingan set
			nama='$nama',
			alamat='$alamat',
			service_date='$service_date',
			no_hp='$no_hp',
			jam='$jam'
			where id=$id";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>
    <h2>Update Data Pembokingan</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?php echo $data['nama'] ?>" class="form-control" placeholder="Masukan Nama" required />

        </div>
        <div class="form-group">
            <label>Jenis Service:</label>
            <input type="text" name="sekolah" value="<?php echo $data['jenis_service'] ?>" class="form-control" placeholder="service yang di pilih" required/>
        </div>
       <div class="form-group">
            <label>Tanggal Service :</label>
            <input type="date" name="service_date" value="<?php echo $data['service_date'] ?>" class="form-control" placeholder="tanggal service" required/>
        </div>
                </p>
        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="no_hp" value="<?php echo $data['no_hp'] ?>" class="form-control" placeholder="Masukan No HP" required/>
        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="jam" value="<?php echo $data['jam'] ?>" class="form-control" placeholder="Masukan No HP" required/>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" class="form-control" value="<?php echo $data['alamat'] ?>" rows="5"placeholder="Masukan Alamat" required></textarea>
        </div>       

        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="index.php" class="btn btn-primary">kembali</a>
    </form>
</div>
</body>
</html>