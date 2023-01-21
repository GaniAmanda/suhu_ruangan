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
    		<th>Tanggal</th>
    		<th>Ruangan</th>
    		<th>Shift</th>
    		<th>Suhu</th>
			<th>Kelembaban</th>
    		<th>Sensor</th>
    	</tr>
    	<?php
		// Load file koneksi.php  
		include "koneksi.php";
		// Buat query untuk menampilkan semua data siswa 
		$no=1;
		$query = mysqli_query($koneksi, "SELECT
		ruangan.ruangan as ruangan_nama,
		suhu.ruangan, 
		suhu.tanggal, 
		suhu.suhu, 
		suhu.kelembapan, 
		suhu.sensor, 
		suhu.modified_date, 
		shift.shift
	FROM
		suhu
		INNER JOIN
		ruangan
		ON 
			suhu.ruangan = ruangan.id_ruangan
		INNER JOIN
		shift
		ON 
			suhu.shift = shift.id_shift
			where suhu.shift!=0");

		while ($data = mysqli_fetch_array($query)) {
			echo "<tr>";
			echo "<td>" . $no. "</td>";
			echo "<td>" . $data['tanggal'] . "</td>";
			echo "<td>" . $data['ruangan_nama'] . "</td>";
			echo "<td>" . $data['shift'] . "</td>";
			echo "<td>" . $data['suhu'] . "</td>";
			echo "<td>" . $data['kelembapan'] . "</td>";
			echo "<td>" . $data['sensor'] . "</td>";
			echo "</tr>";
			$no+=1;
		}
		?>
    </table>