<?php
//include('dbconnected.php');
session_start();
include('koneksi.php');
$tanggal = $_POST['tanggal'];
$ruangan = $_POST['ruangan'];
$suhu_pagi = $_POST['suhu_pagi'];
$kelembapan_pagi = $_POST['kelembapan_pagi'];
$petugas = $_SESSION['nama'];
$suhu_sore = $_POST['suhu_sore'];
$kelembapan_sore = $_POST['kelembapan_sore'];

if (($suhu_sore == '') & ($kelembapan_sore == '')) {
    $query = mysqli_query($koneksi, "INSERT INTO `suhu` (`tanggal`, `ruangan`, `suhu_pagi`,`kelembapan_pagi`,`petugas_pagi`) VALUES 
                                                    ('$tanggal', '$ruangan','$suhu_pagi','$kelembapan_pagi','$petugas')");
} else {
    $query = mysqli_query($koneksi, "INSERT INTO `suhu` (`tanggal`, `ruangan`, `suhu_pagi`,`kelembapan_pagi`,`suhu_sore`,`kelembapan_sore`,`petugas_pagi`,`petugas_sore`) VALUES 
                                                    ('$tanggal', '$ruangan','$suhu_pagi','$kelembapan_pagi','$suhu_sore','$kelembapan_sore','$petugas','$petugas')");
}
if ($query) {
    # credirect ke page index
    header("location:data.php?tambah=sukses");
} else {
    header("location:data.php?tambah=gagal");
}

//mysql_close($host);
