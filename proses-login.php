<?php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$email =mysqli_real_escape_string($koneksi,$_POST['email']);
$pass = mysqli_real_escape_string($koneksi,$_POST['password']);

$sql = "Select * from admin where email='$email'";
$result = mysqli_query($koneksi, $sql);
$num = mysqli_num_rows($result);
if ($num == 1) {
	while ($row = mysqli_fetch_assoc($result)) {
		if (password_verify($pass, $row['password'])) {
			session_start();
			$_SESSION['sid'] = session_id();
			$_SESSION['id'] = $row['id'];
			$_SESSION['nama'] = $row['nama'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['status'] = "login";
			header("location: index.php");
		} else {
			header("location:auth-login.php?pesan=gagal");
		}
	}
} else {
	header("location:auth-login.php?pesan=gagal");
}
