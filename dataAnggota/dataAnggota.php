<?php
require "../config.php";

$result = mysqli_query($conn, "SELECT * FROM data_anggota");

if ( mysqli_num_rows($result) > 0 ) {
 	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
 } else {
 	header("Location: tambahAnggota.php");
 }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Anggota</title>
</head>
<body>
	<header id="header">
		<div class="container">
			<center>
				<a href="../index.php"><img src="../kijangPerpus.png" alt="kijang-nich" width="50"></a>
				<h1>
					Daftar Anggota
				</h1>
			</center>
		</div>
	</header>
	<section id="content">
		<div class="container">
			<center>
				<a href="tambahAnggota.php">Tambah Anggota</a>
				<br><br>
			</center>

			<div id="containerTable">
                <table border="1" cellpadding="10" cellspacing="0" width="100%">
                    <tr>
                        <th>No.</th>
                        <th>No. Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Aksi</th>
                    </tr>

                    <?php $nomer = 1; ?>
                    <?php foreach( $rows as $row ) : ?>

                    <tr>
                        <td><?php echo $nomer; $nomer++;?></td>
                        <td><?= $row["no_anggota"]; ?></td>
                        <td><?= $row["nama_anggota"]; ?></td>
                        <td align="center"><a href="editAnggota.php?no_anggota=<?=$row['no_anggota'];?>">Edit</a> | <a href="hapusAnggota.php?no_anggota=<?=$row['no_anggota'];?>" onclick="return confirm('Yakin Kawan?')">Hapus</a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

		</div>
	</section>
</body>
</html>