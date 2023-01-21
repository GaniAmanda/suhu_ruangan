<?php
//DUMP INISIAL DATA
for ($i = 0; $i <= 3; $i++) {
    $cek = mysqli_query($koneksi, "SELECT * FROM suhu WHERE tanggal ='" . date("Y-m-d") . "' and shift = '$i'");
    $hasil_cek[$i] = mysqli_num_rows($cek);
}
for ($x = 0; $x <= 3; $x++) {
    if ($hasil_cek[$x] == 0) {
        $dump_data = mysqli_query($koneksi, "insert into suhu (tanggal, ruangan,suhu,kelembapan,shift) VALUES ('" . date("Y-m-d") . "',1, NULL, NULL,'$x')");
    }
}
?>