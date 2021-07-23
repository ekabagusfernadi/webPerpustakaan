<?php
require "../config.php";

$id = $_GET["id_transaksi_pengembalian"];
$query = "DELETE FROM transaksi_pengembalian WHERE id_transaksi_pengembalian = '$id'";
mysqli_query($conn, $query);

echo    "<script>
	        alert('Data Berhasil Dihapus');
	        document.location.href = 'dataPengembalian.php';
        </script>";

// header("Location: index.php");

?>