<?php
    include "../koneksi.php";
    $id = $_GET['id'];

    $query = "UPDATE pembokingan SET status='belum'
                WHERE id = '$id'";

    $hasil=mysqli_query($kon, $query);

    if ($hasil) {
        header("Location:index.php");
    }
    else {
        echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";

    }
?>