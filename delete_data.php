<?php
//include('dbconnected.php');
include('koneksi.php');
$id = $_GET['id'];

//query update
$query = mysqli_query($koneksi, "DELETE FROM `suhu` WHERE id = '$id'");

if ($query) {
    # credirect ke page index
    header("location:data.php?hapus=sukses");
} else {
    header("location:data.php?hapus=gagal");
}

//mysql_close($host);
