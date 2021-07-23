<?php
require "../config.php";

$id = $_GET["kode_buku"];
$query = "DELETE FROM data_buku WHERE kode_buku = '$id'";
mysqli_query($conn, $query);

echo    "<script>
	        alert('Data Berhasil Dihapus');
	        document.location.href = 'dataBuku.php';
        </script>";

// header("Location: index.php");

?>