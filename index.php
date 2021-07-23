<?php
require "config.php";



?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
	<header id="header">
		<div class="container">
			<center>
				<a href="index.php"><img src="kijangPerpus.png" alt="kijang-nich" width="50"></a>
				<h1>
					Home
				</h1>
			</center>
		</div>
	</header>
	<section id="content">
		<div class="container">
			<center>
				<a href="dataBuku/dataBuku.php">Data Buku</a>
				<br><br>
				<a href="dataAnggota/dataAnggota.php">Data Anggota</a>
				<br><br>
				<a href="transaksiPeminjaman/dataPeminjaman.php">Transaksi Peminjaman</a>
				<br><br>
				<a href="transaksiPengembalian/dataPengembalian.php">Transaksi Pengembalian</a>
			</center>
		</div>
	</section>
	
</body>
</html>