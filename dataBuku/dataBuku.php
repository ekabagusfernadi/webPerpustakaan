<?php
require "../config.php";

$result = mysqli_query($conn, "SELECT * FROM data_buku ORDER BY kode_buku ASC");

if ( mysqli_num_rows($result) > 0 ) {
 	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
 } else {
 	header("Location: tambahBuku.php");
 }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Buku</title>
</head>
<body>
	<header id="header">
		<div class="container">
			<center>
				<a href="../index.php"><img src="../kijangPerpus.png" alt="kijang-nich" width="50"></a>
				<h1>
					Daftar Buku
				</h1>
			</center>
		</div>
	</header>
	<section id="content">
		<div class="container">
			<center>
				<a href="tambahBuku.php">Tambah Buku</a>
				<br><br>
			</center>

			<div id="containerTable">
                <table border="1" cellpadding="10" cellspacing="0" width="100%">
                    <tr>
                        <th>No.</th>
                        <th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Aksi</th>
                    </tr>

                    <?php $nomer = 1; ?>
                    <?php foreach( $rows as $row ) : ?>

                    <tr>
                        <td><?php echo $nomer; $nomer++;?></td>
                        <td><?= $row["kode_buku"]; ?></td>
                        <td><?= $row["judul_buku"]; ?></td>
                        <td align="center"><a href="editBuku.php?kode_buku=<?=$row['kode_buku'];?>">Edit</a> | <a href="hapusBuku.php?kode_buku=<?=$row['kode_buku'];?>" onclick="return confirm('Yakin Kawan?')">Hapus</a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

		</div>
	</section>
</body>
</html>