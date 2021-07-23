<?php
require "../config.php";

// ambil data anggota lama dan buku lama
$id = $_GET["id_transaksi_pinjam_buku"];
$queryAnggotaLama = "SELECT transaksi_pinjam_buku.no_anggota, nama_anggota, data_buku.kode_buku, judul_buku
    FROM transaksi_pinjam_buku
    JOIN data_anggota ON(transaksi_pinjam_buku.no_anggota = data_anggota.no_anggota)
    JOIN data_buku ON(transaksi_pinjam_buku.kode_buku = data_buku.kode_buku)
    WHERE id_transaksi_pinjam_buku = '$id'
";
$objectAnggotaLama = mysqli_query($conn, $queryAnggotaLama);

$AnggotaLama = mysqli_fetch_assoc($objectAnggotaLama);

// ambil data anggota yg boleh pinjam buku
$noAnggotaLama = $AnggotaLama["no_anggota"];
$queryAnggotaTersedia = "SELECT no_anggota, nama_anggota FROM data_anggota
    WHERE no_anggota NOT IN 
    (SELECT tabel_grup_jumlah_peminjaman.no_anggota
    FROM (SELECT transaksi_pinjam_buku.no_anggota, COUNT(transaksi_pinjam_buku.no_anggota) AS jumlah_peminjaman
    FROM transaksi_pinjam_buku
    WHERE `status` = 'BELUM KEMBALI'
    GROUP BY transaksi_pinjam_buku.no_anggota
    HAVING jumlah_peminjaman >= 3) AS tabel_grup_jumlah_peminjaman)
    AND no_anggota != '$noAnggotaLama'
";
$objectAnggotaTersedia = mysqli_query($conn, $queryAnggotaTersedia);

$members = [];
while( $member = mysqli_fetch_assoc($objectAnggotaTersedia) ) {
    $members[] = $member;
}

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

if( isset($_POST["submit"]) ) {

    $noAnggotaPeminjamUpdate = $_POST["noAnggotaPeminjam"];
    $kodeBukuDipinjamUpdate = $_POST["kodeBukuDipinjam"];

    // update ketersediaan
    $kodeBukuLama = $AnggotaLama["kode_buku"];
    if( $kodeBukuDipinjamUpdate != $kodeBukuLama ) {
        mysqli_query($conn, "UPDATE data_buku_tersedia SET ketersediaan = 'TERSEDIA' WHERE kode_buku = '$kodeBukuLama'");
        mysqli_query($conn, "UPDATE data_buku_tersedia SET ketersediaan = 'KOSONG' WHERE kode_buku = '$kodeBukuDipinjamUpdate'");
    }

    // update database
    mysqli_query($conn, "UPDATE transaksi_pinjam_buku SET
        no_anggota = '$noAnggotaPeminjamUpdate',
        kode_buku = '$kodeBukuDipinjamUpdate'
        WHERE id_transaksi_pinjam_buku = '$id'
    ");
    // header("Location: dataAnggota.php");
    echo    "<script>
	        alert('Data Berhasil Diedit');
	        document.location.href = 'dataPeminjaman.php';
        </script>";

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota</title>
    <link href="../select2-4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="">
    <header id="header">
        <div class="container">
            <center>
                <a href="../index.php"><img src="../kijangPerpus.png" alt="kijang-nich" width="50"></a>
                <h1>
                    Edit Anggota
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
                            <label for="noAnggota">Nama Peminjam</label>  
                        </td>
                        <td>
                            : <select name="noAnggotaPeminjam" id="noAnggotaPeminjam" required>
                                <option value="<?= $AnggotaLama["no_anggota"]; ?>" selected><?= $AnggotaLama["no_anggota"] . " ( " . $AnggotaLama["nama_anggota"] . " ) " ?></option>
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
                                <option value="<?= $AnggotaLama["kode_buku"]; ?>" selected><?= $AnggotaLama["kode_buku"] . " ( " . $AnggotaLama["judul_buku"] . " ) " ?></option>
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