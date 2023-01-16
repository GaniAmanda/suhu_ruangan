<?php
//include('dbconnected.php');
include('koneksi.php');
$jenis = $_POST['jenis'];

$query = mysqli_query($koneksi, "INSERT INTO `jenis` (`jenis`) VALUES ('$jenis')");
if ($query) {
    # credirect ke page index
    header("location:master-jenis.php?tambah=sukses");
} else {
    header("location:master-jenis.php?tambah=gagal");
}

//mysql_close($host);
