<?php
require "../config.php";

// ambil data id transaksi pinjam buku
$queryTampilIdTransaksiPinjamBuku = "SELECT id_transaksi_pinjam_buku, data_buku.kode_buku, judul_buku
    FROM transaksi_pinjam_buku
    JOIN data_buku ON(transaksi_pinjam_buku.kode_buku = data_buku.kode_buku)
    WHERE `status` = 'BELUM KEMBALI';
";
$objectTampilIdTransaksiPinjamBuku = mysqli_query($conn, $queryTampilIdTransaksiPinjamBuku);

$idRents = [];
while( $idRent = mysqli_fetch_assoc($objectTampilIdTransaksiPinjamBuku) ) {
    $idRents[] = $idRent;
}



if( isset($_POST["submit"]) ) {
    $idTransaksiPinjamBuku = $_POST["idTransaksiPinjamBuku"];
    
    // insert ke database
    mysqli_query($conn, "INSERT INTO transaksi_pengembalian(id_transaksi_pinjam_buku) VALUES ('$idTransaksiPinjamBuku')");
    // header("Location: dataPengembalian.php");

    // update status TransaksiPinjamBuku
    $updateStatusTransaksiPinjamBuku = "UPDATE transaksi_pinjam_buku SET `status` = 'SUDAH KEMBALI' WHERE id_transaksi_pinjam_buku = '$idTransaksiPinjamBuku'";
    mysqli_query($conn, $updateStatusTransaksiPinjamBuku);

    // update ketersediaan data_buku_tersedia
    $queryAmbilKodeBuku = "SELECT kode_buku
        FROM transaksi_pinjam_buku WHERE id_transaksi_pinjam_buku = '$idTransaksiPinjamBuku'
    ";
    $objectAmbilKodeBuku = mysqli_query($conn, $queryAmbilKodeBuku);
    $kodeBukuDikembalikan = mysqli_fetch_assoc($objectAmbilKodeBuku)["kode_buku"];

    $updateKetersediaanDataBuku = "UPDATE data_buku_tersedia SET ketersediaan = 'TERSEDIA' WHERE kode_buku = '$kodeBukuDikembalikan'";
    mysqli_query($conn, $updateKetersediaanDataBuku);

    echo    "<script>
	        alert('Data Berhasil Ditambahkan');
	        document.location.href = 'dataPengembalian.php';
        </script>";

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Pengembalian</title>
    <link href="../select2-4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="">
	<header id="header">
		<div class="container">
			<center>
                <a href="../index.php"><img src="../kijangPerpus.png" alt="kijang-nich" width="50"></a>
				<h1>
					Tambah Pengembalian
				</h1>
			</center>
		</div>
	</header>
	<section id="content">
		<div class="container">

			<div id="containerTable">
                <form method="post">
                	<table cellpadding="10" cellspacing="0" align="center">
                    
                    <tr>
                    	<td>
                        	<label for="idTransaksiPinjamBuku">ID Transaksi Pinjam Buku</label>	
                        </td>
                        <td>
                            : <select name="idTransaksiPinjamBuku" id="idTransaksiPinjamBuku" required>
                                <option value="" disabled selected>Pilih ID Transaksi Pinjam Buku</option>
                                <?php foreach( $idRents as $idRent ) : ?>
                                    <option value="<?= $idRent["id_transaksi_pinjam_buku"]; ?>"><?= $idRent["id_transaksi_pinjam_buku"] . " ( " . $idRent["judul_buku"] . " ) "; ?></option>
                                <?php endforeach; ?>
                            </select>	
                        </td>
                    </tr>
                    
                    <tr>
                    	<td>
                        	<button type="submit" name="submit" onclick="return confirm('Yakin Kawan?')">Submit!</button>	
                        </td>
                
                    </tr>
                   
                </table>
                </form>
            </div>

		</div>
	</section>
    <script src="../jquery-3.6.0.js"></script>
    <script src="../select2-4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../scriptSelect2.js"></script>
</body>
</html>