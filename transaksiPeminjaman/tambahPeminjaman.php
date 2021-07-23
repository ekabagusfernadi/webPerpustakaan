<?php
require "../config.php";

// ambil data buku tersedia
$queryBukuTersedia = "SELECT kode_buku, judul_buku
    FROM data_buku_tersedia WHERE ketersediaan = 'TERSEDIA'
    ORDER BY kode_buku ASC
";
$objectBukuTersedia = mysqli_query($conn, $queryBukuTersedia);

$books = [];
while( $book = mysqli_fetch_assoc($objectBukuTersedia) ) {
    $books[] = $book;
}

// ambil data anggota yg boleh pinjam buku
$queryAnggotaTersedia = "SELECT no_anggota, nama_anggota FROM data_anggota
    WHERE no_anggota NOT IN 
    (SELECT tabel_grup_jumlah_peminjaman.no_anggota
    FROM (SELECT transaksi_pinjam_buku.no_anggota, COUNT(transaksi_pinjam_buku.no_anggota) AS jumlah_peminjaman
    FROM transaksi_pinjam_buku
    WHERE `status` = 'BELUM KEMBALI'
    GROUP BY transaksi_pinjam_buku.no_anggota
    HAVING jumlah_peminjaman >= 3) AS tabel_grup_jumlah_peminjaman)
";
$objectAnggotaTersedia = mysqli_query($conn, $queryAnggotaTersedia);

$members = [];
while( $member = mysqli_fetch_assoc($objectAnggotaTersedia) ) {
    $members[] = $member;
}

if( isset($_POST["submit"]) ) {
    $noAnggotaPeminjamBaru = $_POST["noAnggotaPeminjam"];
    $kodeBukuDipinjam = $_POST["kodeBukuDipinjam"];
    
    // insert ke database
    mysqli_query($conn, "INSERT INTO transaksi_pinjam_buku(no_anggota, kode_buku, batas_pengembalian_buku) VALUES ('$noAnggotaPeminjamBaru', '$kodeBukuDipinjam', DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 7 DAY))");
    // update buku tersedia
    mysqli_query($conn, "UPDATE data_buku_tersedia SET ketersediaan = 'KOSONG' WHERE kode_buku = '$kodeBukuDipinjam'");
    
    // header("Location: dataPeminjaman.php");
    echo    "<script>
	        alert('Data Berhasil Ditambahkan');
	        document.location.href = 'dataPeminjaman.php';
        </script>";

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Peminjaman</title>
    <link href="../select2-4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="">
	<header id="header">
		<div class="container">
			<center>
                <a href="../index.php"><img src="../kijangPerpus.png" alt="kijang-nich" width="50"></a>
				<h1>
					Tambah Peminjaman
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
                        	<label for="noAnggotaPeminjam">Nama Peminjam</label>	
                        </td>
                        <td>
                        	: <select name="noAnggotaPeminjam" id="noAnggotaPeminjam" required>
                                <option value="" disabled selected>Pilih Anggota Tersedia</option>
                                <?php foreach( $members as $member ) : ?>
                                    <option value="<?= $member["no_anggota"]; ?>"><?= $member["no_anggota"] . " ( " . $member["nama_anggota"] . " ) "; ?></option>
                                <?php endforeach; ?>
                            </select>	
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label for="kodeBukuDipinjam">Buku yang Dipinjam</label>	
                        </td>
                        <td>
                        	: <select name="kodeBukuDipinjam" id="kodeBukuDipinjam" required>
                                <option value="" disabled selected>Pilih Buku Tersedia</option>
                                <?php foreach( $books as $book ) : ?>
                                    <option value="<?= $book["kode_buku"]; ?>"><?= $book["kode_buku"] . " ( " . $book["judul_buku"] . " ) "; ?></option>
                                <?php endforeach; ?>
                            </select>	
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<button type="submit" name="submit">Submit!</button>	
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