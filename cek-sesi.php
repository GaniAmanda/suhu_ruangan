	<!-- cek apakah sudah login -->
	<?php 
	session_start();
	require 'koneksi.php';
	if($_SESSION['status']!="login"){
		header("location:auth-login.php?pesan=belum_login");
	}
	?>