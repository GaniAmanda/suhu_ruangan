<?php
//include('dbconnected.php');
include('koneksi.php');
$pendidikan = $_POST['pendidikan'];

$query = mysqli_query($koneksi, "INSERT INTO `pendidikan` (`pendidikan`) VALUES ('$pendidikan')");
if ($query) {
    # credirect ke page index
    header("location:master-pendidikan.php?tambah=sukses");
} else {
    header("location:master-pendidikan.php?tambah=gagal");
}

//mysql_close($host);
