<?php
session_start();
//include('dbconnected.php');
include('koneksi.php');
$id = $_POST['id'];
$tanggal = $_POST['tanggal'];
$ruangan = $_POST['ruangan'];
$suhu_pagi = $_POST['suhu_pagi'];
$kelembapan_pagi = $_POST['kelembapan_pagi'];
$petugas_pagi = $_POST['petugas_pagi'];
$suhu_sore = $_POST['suhu_sore'];
$kelembapan_sore = $_POST['kelembapan_sore'];
$petugas_sore = $_SESSION['nama'];


$query = mysqli_query($koneksi, "UPDATE suhu SET tanggal='$tanggal' ,ruangan='$ruangan',suhu_pagi='$suhu_pagi', kelembapan_pagi='$kelembapan_pagi',suhu_sore='$suhu_sore', kelembapan_sore='$kelembapan_sore', petugas_sore='$petugas_sore' WHERE id='$id'");
if ($query) {
    # credirect ke page index
    header("location:data.php?update=sukses");
} else {
    header("location:data.php?update=gagal");
}

//mysql_close($host);
