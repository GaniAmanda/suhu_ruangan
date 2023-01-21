<?php
// menghubungkan dengan koneksi
require_once 'koneksi.php';
if (isset($_POST['register'])) {
	$username = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $useremail =mysqli_real_escape_string($koneksi, $_POST["email"]);
    $password = mysqli_real_escape_string($koneksi, $_POST["password"]);
    // $exists=false;

    // Check whether this username exists
    $existSql = "SELECT * FROM `admin` WHERE email = '$useremail'";
    $result = mysqli_query($koneksi, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        header("location:auth-register.php?register=exist");
    }
    else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `admin` ( `nama`, `email`, `password`) VALUES ('$username', '$useremail', '$hash')";
            $result = mysqli_query($koneksi, $sql);
			header("location:auth-register.php?register=sukses");

    }
}
?>