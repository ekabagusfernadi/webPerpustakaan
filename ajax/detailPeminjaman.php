<?php
require "../config.php";

if( isset($_GET["kode_buku"]) ) {
    $kodeBuku = $_GET["kode_buku"];
    $queryAmbilDataPeminjaman = "SELECT transaksi_pinjam_buku.id_transaksi_pinjam_buku, transaksi_pinjam_buku.no_anggota, transaksi_pinjam_buku.kode_buku, transaksi_pinjam_buku.tanggal_pinjam_buku, transaksi_pinjam_buku.batas_pengembalian_buku, transaksi_pinjam_buku.status, data_anggota.nama_anggota, data_buku.judul_buku
    FROM transaksi_pinjam_buku
    JOIN data_anggota ON(transaksi_pinjam_buku.no_anggota = data_anggota.no_anggota)
    JOIN data_buku ON(transaksi_pinjam_buku.kode_buku = data_buku.kode_buku)
    WHERE transaksi_pinjam_buku.kode_buku = '$kodeBuku'
    ORDER BY transaksi_pinjam_buku.id_transaksi_pinjam_buku ASC
";
} else {
    $noAnggota = $_GET["no_anggota"];
    $queryAmbilDataPeminjaman = "SELECT transaksi_pinjam_buku.id_transaksi_pinjam_buku, transaksi_pinjam_buku.no_anggota, transaksi_pinjam_buku.kode_buku, transaksi_pinjam_buku.tanggal_pinjam_buku, transaksi_pinjam_buku.batas_pengembalian_buku, transaksi_pinjam_buku.status, data_anggota.nama_anggota, data_buku.judul_buku
    FROM transaksi_pinjam_buku
    JOIN data_anggota ON(transaksi_pinjam_buku.no_anggota = data_anggota.no_anggota)
    JOIN data_buku ON(transaksi_pinjam_buku.kode_buku = data_buku.kode_buku)
    WHERE transaksi_pinjam_buku.no_anggota = '$noAnggota'
    ORDER BY transaksi_pinjam_buku.id_transaksi_pinjam_buku ASC
";
}






$result = mysqli_query($conn, $queryAmbilDataPeminjaman);

if ( mysqli_num_rows($result) > 0 ) {
 	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
 } else {
 	echo "Data Kosong";
 }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Transaksi Pinjam Buku</title>
    <link rel="stylesheet" href="../style.css" />
</head>
<body>
	<header id="header">
		<div class="container">
			<center>
                <a href="../index.php"><img src="../kijangPerpus.png" alt="kijang-nich" width="50"></a>
				<h1>
					Daftar Transaksi Pinjam Buku
				</h1>
			</center>
		</div>
	</header>
	<section id="content">
		<div class="container">

			<div id="containerTable">
                <table border="1" cellpadding="10" cellspacing="0" width="100%">
                    <tr>
                        <th>No.</th>
                        <th>ID Transaksi Pinjam Buku</th>
                        <th>No Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam Buku</th>
                        <th>Batas Pengembalian Buku</th>
                        <th>Status</th>
                        
                    </tr>

                    <?php $nomer = 1; ?>
                    <?php foreach( $rows as $row ) : ?>

                    <?php
                        $tanggalBatas = $row["batas_pengembalian_buku"];
                        $timeTanggalBatas = strtotime("$tanggalBatas");
                        $timeHariIni = time();
                        // echo date("d - M - Y", $timeTanggal);
                        //  echo time() + (60*60*24*2);
                    ?>

                    <tr>
                        <td><?php echo $nomer; $nomer++;?></td>
                        <td><?= $row["id_transaksi_pinjam_buku"]; ?></td>
                        <td><?= $row["no_anggota"]; ?></td>
                        <td><?= $row["nama_anggota"]; ?></td>
                        <td><?= $row["kode_buku"]; ?></td>
                        <td><?= $row["judul_buku"]; ?></td>
                        <td><?= $row["tanggal_pinjam_buku"]; ?></td>
                        <?php
                            if( $row["status"] == "SUDAH KEMBALI" ) {
                                echo "<td style='background-color: lightgreen'>$tanggalBatas</td>";
                            } else if( $timeHariIni > $timeTanggalBatas ) {
                                echo "<td style='background-color: red'>$tanggalBatas</td>";
                            } else {
                                echo "<td style='background-color: yellow'>$tanggalBatas</td>";
                            }
                        ?>
                        <td><?= $row["status"]; ?></td>
                        
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

		</div>
	</section>
    
</body>
</html>