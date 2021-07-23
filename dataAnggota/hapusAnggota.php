<?php
require "../config.php";

$id = $_GET["no_anggota"];
$query = "DELETE FROM data_anggota WHERE no_anggota = '$id'";
mysqli_query($conn, $query);

echo    "<script>
	        alert('Data Berhasil Dihapus');
	        document.location.href = 'dataAnggota.php';
        </script>";

// header("Location: index.php");

?>