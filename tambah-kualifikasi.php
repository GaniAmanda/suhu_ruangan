<?php
//include('dbconnected.php');
include('koneksi.php');
$kualifikasi = $_POST['kualifikasi'];

$query = mysqli_query($koneksi, "INSERT INTO `kualifikasi` (`kualifikasi`) VALUES ('$kualifikasi')");
if ($query) {
    # credirect ke page index
    header("location:master-kualifikasi.php?tambah=sukses");
} else {
    header("location:master-kualifikasi.php?tambah=gagal");
}

//mysql_close($host);
