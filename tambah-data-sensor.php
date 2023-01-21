<?php
//include('dbconnected.php');
include('koneksi.php');
$id = $_POST['id'];
$search_api = mysqli_query($koneksi, "SELECT api_key from sensor where id_sensor='$id'");
$result_api = mysqli_fetch_assoc($search_api);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if ($api_key == $result_api['api_key']) {
        $tanggal = $_POST['tanggal'];
        $ruangan = $_POST['ruangan'];
        $suhu = $_POST['suhu'];
        $kelembapan = $_POST['kelembapan'];
        $shift = $_POST['shift'];
        $sql = "Select * from suhu where tanggal='$tanggal' and shift = '$shift'";
        $result = mysqli_query($koneksi, $sql);
        $data = mysqli_fetch_assoc($result);
        $num = mysqli_num_rows($result);
        if ($data['shift'] == $shift && $num > 0) {
            $query = mysqli_query($koneksi, "UPDATE `suhu` SET `ruangan` = '$ruangan', `suhu`='$suhu',`kelembapan` = '$kelembapan',`sensor`='$id',`shift` = '$shift' where `tanggal` = '$tanggal' and `shift` = '$shift'");
        } else {
            $query = mysqli_query($koneksi, "INSERT INTO `suhu` (`tanggal`, `ruangan`, `suhu`,`kelembapan`,`sensor`,`shift`) VALUES 
        ('$tanggal', '$ruangan','$suhu','$kelembapan','$id','$shift')");
        }
    } else {
        echo "API Key tidak dikenal";
    }
} else {
    echo "Tidak ada data di POST";
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
