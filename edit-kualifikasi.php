<?php
//include('dbconnected.php');
include('koneksi.php');
$id_kualifikasi=$_POST['id_kualifikasi'];
$kualifikasi = $_POST['kualifikasi'];

$query = mysqli_query($koneksi, "UPDATE kualifikasi SET kualifikasi='$kualifikasi' WHERE id_kualifikasi='$id_kualifikasi'");
if ($query) {
    # credirect ke page index
    header("location:master-kualifikasi.php?update=sukses");
} else {
    header("location:master-kualifikasi.php?update=gagal");
}

//mysql_close($host);
