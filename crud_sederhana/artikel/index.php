<!DOCTYPE html>
<html>

<head>
  <link rel='icon' href='../img/foto1.jpeg'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<title>
  HALLO BENGKEL ARTIKEL</title>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="../login/halaman_admin.php">HALLO BENGKEL</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
      </div>
    </div>
  </nav>
  <div class="container">
    <br>
    <h4>
      <center>Artikel</center>
    </h4>
    <?php

    include "../koneksi.php";

    //Cek apakah ada kiriman form dari method post
    if (isset($_GET['id'])) {
      $id = htmlspecialchars($_GET["id"]);

      $sql = "delete from artikel where id='$id' ";
      $hasil = mysqli_query($kon, $sql);

      //Kondisi apakah berhasil atau tidak
      if ($hasil) {
        header("Location:index.php");
      } else {
        echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
      }
    }
    ?>


    <tr class="table-danger">
      <br>
      <thead>
        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
        <tr>
          <table class="my-3 table table-bordered">
            <tr class="table-primary">
              <th>No</th>
              <th>Judul</th>
              <th>Deskripsi</th>
              <th>Gambar</th>
              <th>Status</th>
              <th colspan='2'>Aksi</th>

            </tr>
      </thead>

      <?php
      include "../koneksi.php";
      $sql = "select * from artikel";

      $hasil = mysqli_query($kon, $sql);
      $no = 0;
      while ($data = mysqli_fetch_array($hasil)) {
        $no++;

      ?>
        <tbody>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data["judul"]; ?></td>
            <td><?php echo $data["deskripsi"];   ?></td>
            <td><?php echo $data["gambar"];   ?></td>
            <td><?php echo $data["is_posting"];   ?></td>
            <td>
              <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Update</a>
              <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $data['id']; ?>" class="btn btn-danger" role="button">Delete</a>
              <?php
              ?>
            </td>
          </tr>
        </tbody>
      <?php
      }
      ?>
      </table>
  </div>
</body>

</html>