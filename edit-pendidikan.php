<?php
//include('dbconnected.php');
include('koneksi.php');
$id_pendidikan=$_POST['id_pendidikan'];
$pendidikan = $_POST['pendidikan'];

$query = mysqli_query($koneksi, "UPDATE pendidikan SET pendidikan='$pendidikan' WHERE id_pendidikan='$id_pendidikan'");
if ($query) {
    # credirect ke page index
    header("location:master-pendidikan.php?update=sukses");
} else {
    header("location:master-pendidikan.php?update=gagal");
}

//mysql_close($host);
