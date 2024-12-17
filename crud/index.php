<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<title>
  HALLO BENGKEL</title>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="../login/halaman_admin.php">HALLO BENGKEL</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/jenis_service/index.php">Jenis produk</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <br>
    <h4>
      <center>DAFTAR PEMBOKINGAN</center>
    </h4>
    <?php

    include "../koneksi.php";

    //Cek apakah ada kiriman form dari method post
    if (isset($_GET['id'])) {
      $id = htmlspecialchars($_GET["id"]);

      $sql = "delete from pembokingan where id='$id' ";
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
              <th>Nama</th>
              <th>Tanggal</th>
              <th>jam</th>
              <th>Jenis service</th>
              <th>No Hp</th>
              <th>Alamat</th>
              <th>status</th>
              <th colspan='2'>Aksi</th>

            </tr>
      </thead>

      <?php
      include "../koneksi.php";
      $sql = "select pembokingan.id, pembokingan.nama, pembokingan.service_date, pembokingan.no_hp, pembokingan.jam, pembokingan.id_jenis_service, pembokingan.alamat, jenis_service.nama_service, pembokingan.status
        from pembokingan
        left join jenis_service on pembokingan.id_jenis_service = jenis_service.id
        order by pembokingan.id desc";

      $hasil = mysqli_query($kon, $sql);
      $no = 0;
      while ($data = mysqli_fetch_array($hasil)) {
        $no++;

      ?>
        <tbody>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data["nama"]; ?></td>
            <td><?php echo $data["service_date"];   ?></td>
            <td><?php echo $data["jam"];   ?></td>
            <td><?php echo $data["nama_service"];   ?></td>
            <td><?php echo $data["no_hp"];   ?></td>
            <td><?php echo $data["alamat"];   ?></td>
            <td><?php echo $data["status"];   ?></td>
            <td>
              <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Update</a>
              <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $data['id']; ?>" class="btn btn-danger" role="button">Delete</a>
              <?php
              if ($data['status'] == 'belum') { ?>

                <a href="update-status.php?id=<?php echo $data['id'] ?>" class="btn btn-success"> Selesai </a>
              
                <?php } else { ?>
                  <a href="status.php?id=<?php echo $data['id'] ?>" class="btn btn-secondary"> Belum </a>
               <?php }?>
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