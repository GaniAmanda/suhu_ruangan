    <?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Database_Suhu.xls");
	?>
    <style type="text/css">
    	body {
    		font-family: sans-serif;
    	}

    	table {
    		margin: 20px auto;
    		border-collapse: collapse;
    	}

    	table th,
    	table td {
    		border: 1px solid #3c3c3c;
    		padding: 3px 8px;

    	}

    	a {
    		background: blue;
    		color: #fff;
    		padding: 8px 10px;
    		text-decoration: none;
    		border-radius: 2px;
    	}

    	.str {
    		mso-number-format: \@;
    	}
    </style>
    <h3>Database Suhu</h3>
    <table border="1" cellpadding="5">
    	<tr>
    		<th>No</th>
    		<th>Ruangan</th>
    		<th>Tanggal</th>
    		<th>Suhu Pagi</th>
    		<th>Kelembaban Pagi</th>
			<th>Petugas catat</th>
    		<th>Suhu Sore</th>
    		<th>Kelembaban Sore</th>
    		<th>Petugas Catat</th>
    	</tr>
    	<?php
		// Load file koneksi.php  
		include "koneksi.php";
		// Buat query untuk menampilkan semua data siswa 
		$no=1;
		$query = mysqli_query($koneksi, "SELECT
		suhu.tanggal, 
		ruangan.ruangan, 
		suhu.suhu_pagi, 
		suhu.kelembapan_pagi, 
		suhu.petugas_pagi, 
		suhu.suhu_sore, 
		suhu.kelembapan_sore, 
		suhu.petugas_sore
	FROM
		suhu
		INNER JOIN
		ruangan
		ON 
			suhu.ruangan = ruangan.id_ruangan order by tanggal asc;");
		// Untuk penomoran tabel, di awal set dengan 1 
		while ($data = mysqli_fetch_array($query)) {
			// Ambil semua data dari hasil eksekusi $sql 
			echo "<tr>";
			echo "<td>" . $no. "</td>";
			echo "<td>" . $data['ruangan'] . "</td>";
			echo "<td>" . $data['tanggal'] . "</td>";
			echo "<td>" . $data['suhu_pagi'] . "</td>";
			echo "<td>" . $data['kelembapan_pagi'] . "</td>";
			echo "<td>" . $data['petugas_pagi'] . "</td>";
			echo "<td>" . $data['suhu_sore'] . "</td>";
			echo "<td>" . $data['kelembapan_sore'] . "</td>";
			echo "<td>" . $data['petugas_sore'] . "</td>";
			echo "</tr>";
		}
		$no+=1;
		?>
    </table>