<?php
require "../config.php";

$id = $_GET["id_transaksi_pinjam_buku"];

// // update ketersediaan buku di data_buku_tersedia
// // ambil kode_buku
// $queryAmbilKodeBuku = "SELECT kode_buku
//     FROM transaksi_pinjam_buku WHERE id_transaksi_pinjam_buku = '$id'
// ";
// $objectAmbilKodeBuku = mysqli_query($conn, $queryAmbilKodeBuku);
// $kodeBuku = mysqli_fetch_assoc($objectAmbilKodeBuku)["kode_buku"];
// // update ketersediaan jadi tersedia
// $queryUpdateKetersediaan = "UPDATE data_buku_tersedia SET ketersediaan = 'TERSEDIA' WHERE kode_buku = '$kodeBuku'";
// mysqli_query($conn, $queryUpdateKetersediaan);

// hapus data
$query = "DELETE FROM transaksi_pinjam_buku WHERE id_transaksi_pinjam_buku = '$id'";
mysqli_query($conn, $query);

echo    "<script>
	        alert('Data Berhasil Dihapus');
	        document.location.href = 'dataPeminjaman.php';
        </script>";

// header("Location: index.php");

?>