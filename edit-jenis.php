<?php
//include('dbconnected.php');
include('koneksi.php');
$id_jenis=$_POST['id_jenis'];
$jenis = $_POST['jenis'];

$query = mysqli_query($koneksi, "UPDATE jenis SET jenis='$jenis' WHERE id_jenis='$id_jenis'");
if ($query) {
    # credirect ke page index
    header("location:master-jenis.php?update=sukses");
} else {
    header("location:master-jenis.php?update=gagal");
}

//mysql_close($host);
