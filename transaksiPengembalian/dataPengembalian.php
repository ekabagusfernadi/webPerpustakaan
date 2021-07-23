<?php
require "../config.php";

$query = "SELECT transaksi_pengembalian.id_transaksi_pengembalian, transaksi_pengembalian.id_transaksi_pinjam_buku, data_anggota.nama_anggota, data_buku.judul_buku, transaksi_pengembalian.tanggal_pengembalian_buku
	FROM transaksi_pengembalian
	JOIN transaksi_pinjam_buku ON(transaksi_pengembalian.id_transaksi_pinjam_buku = transaksi_pinjam_buku.id_transaksi_pinjam_buku)
	JOIN data_anggota ON(transaksi_pinjam_buku.no_anggota = data_anggota.no_anggota)
	JOIN data_buku ON(transaksi_pinjam_buku.kode_buku = data_buku.kode_buku)
	ORDER BY transaksi_pengembalian.id_transaksi_pengembalian ASC
";
$result = mysqli_query($conn, $query);

if ( mysqli_num_rows($result) > 0 ) {
 	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
 } else {
 	header("Location: tambahPengembalian.php");
 }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Transaksi Pengembalian Buku</title>
</head>
<body>
	<header id="header">
		<div class="container">
			<center>
				<a href="../index.php"><img src="../kijangPerpus.png" alt="kijang-nich" width="50"></a>
				<h1>
					Daftar Transaksi Pengembalian Buku
				</h1>
			</center>
		</div>
	</header>
	<section id="content">
		<div class="container">
			<center>
				<a href="tambahPengembalian.php">Tambah Pengembalian</a>
				<br><br>
			</center>

			<div id="containerTable">
                <table border="1" cellpadding="10" cellspacing="0" width="100%">
                    <tr>
                        <th>No.</th>
                        <th>ID Transaksi Pengembalian</th>
                        <th>ID Transaksi Pinjam Buku</th>
                        <th>Nama Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pengembalian Buku</th>
                        <th>Aksi</th>
                    </tr>

                    <?php $nomer = 1; ?>
                    <?php foreach( $rows as $row ) : ?>

                    <tr>
                        <td><?php echo $nomer; $nomer++;?></td>
                        <td><?= $row["id_transaksi_pengembalian"]; ?></td>
                        <td><?= $row["id_transaksi_pinjam_buku"]; ?></td>
                        <td><?= $row["nama_anggota"]; ?></td>
                        <td><?= $row["judul_buku"]; ?></td>
                        <td><?= $row["tanggal_pengembalian_buku"]; ?></td>
                        <td align="center"><a href="hapusPengembalian.php?id_transaksi_pengembalian=<?=$row['id_transaksi_pengembalian'];?>" onclick="return confirm('Yakin Kawan?')">Hapus</a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

		</div>
	</section>
</body>
</html>