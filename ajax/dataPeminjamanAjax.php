<?php
require "../config.php";

$keyword = $_GET["keyword"];
$status = $_GET["status"];

$queryPencarian = "SELECT transaksi_pinjam_buku.id_transaksi_pinjam_buku, transaksi_pinjam_buku.no_anggota, transaksi_pinjam_buku.kode_buku, transaksi_pinjam_buku.tanggal_pinjam_buku, transaksi_pinjam_buku.batas_pengembalian_buku, transaksi_pinjam_buku.status, data_anggota.nama_anggota, data_buku.judul_buku
    FROM transaksi_pinjam_buku
    JOIN data_anggota ON(transaksi_pinjam_buku.no_anggota = data_anggota.no_anggota)
    JOIN data_buku ON(transaksi_pinjam_buku.kode_buku = data_buku.kode_buku)
    WHERE 
    (transaksi_pinjam_buku.no_anggota LIKE '%$keyword%'
    OR transaksi_pinjam_buku.kode_buku LIKE '%$keyword%'
    OR data_anggota.nama_anggota LIKE '%$keyword%'
    OR data_buku.judul_buku LIKE '%$keyword%')
    AND `status` = '$status'
    ORDER BY transaksi_pinjam_buku.id_transaksi_pinjam_buku ASC
";

if( $status == "SEMUA" ) {
    $queryPencarian = "SELECT transaksi_pinjam_buku.id_transaksi_pinjam_buku, transaksi_pinjam_buku.no_anggota, transaksi_pinjam_buku.kode_buku, transaksi_pinjam_buku.tanggal_pinjam_buku, transaksi_pinjam_buku.batas_pengembalian_buku, transaksi_pinjam_buku.status, data_anggota.nama_anggota, data_buku.judul_buku
    FROM transaksi_pinjam_buku
    JOIN data_anggota ON(transaksi_pinjam_buku.no_anggota = data_anggota.no_anggota)
    JOIN data_buku ON(transaksi_pinjam_buku.kode_buku = data_buku.kode_buku)
    WHERE 
    (transaksi_pinjam_buku.no_anggota LIKE '%$keyword%'
    OR transaksi_pinjam_buku.kode_buku LIKE '%$keyword%'
    OR data_anggota.nama_anggota LIKE '%$keyword%'
    OR data_buku.judul_buku LIKE '%$keyword%')
    ORDER BY transaksi_pinjam_buku.id_transaksi_pinjam_buku ASC
";
}

if( $status == "MELEWATI BATAS" ) {
    $queryPencarian = "SELECT transaksi_pinjam_buku.id_transaksi_pinjam_buku, transaksi_pinjam_buku.no_anggota, transaksi_pinjam_buku.kode_buku, transaksi_pinjam_buku.tanggal_pinjam_buku, transaksi_pinjam_buku.batas_pengembalian_buku, transaksi_pinjam_buku.status, data_anggota.nama_anggota, data_buku.judul_buku
    FROM transaksi_pinjam_buku
    JOIN data_anggota ON(transaksi_pinjam_buku.no_anggota = data_anggota.no_anggota)
    JOIN data_buku ON(transaksi_pinjam_buku.kode_buku = data_buku.kode_buku)
    WHERE 
    (transaksi_pinjam_buku.no_anggota LIKE '%$keyword%'
    OR transaksi_pinjam_buku.kode_buku LIKE '%$keyword%'
    OR data_anggota.nama_anggota LIKE '%$keyword%'
    OR data_buku.judul_buku LIKE '%$keyword%')
    AND CURRENT_DATE() > batas_pengembalian_buku
    AND status = 'BELUM KEMBALI'
    ORDER BY transaksi_pinjam_buku.id_transaksi_pinjam_buku ASC
";
}

$objekQueryPencarian = mysqli_query($conn, $queryPencarian);

if ( mysqli_num_rows($objekQueryPencarian) > 0 ) {
    $rows = [];
    while ($row = mysqli_fetch_assoc($objekQueryPencarian)) {
        $rows[] = $row;
    }
} else {
    echo "Lek Nulis Sing Bener Bos! Tak Antemi Sisan Peno!";
    die;
}


?>

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
        <th>Aksi</th>
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
        <?php if( $row["status"] == "SUDAH KEMBALI" ) : ?>
            <td align="center"><a href="hapusPeminjaman.php?id_transaksi_pinjam_buku=<?=$row['id_transaksi_pinjam_buku'];?>" onclick="return confirm('Yakin Kawan?')">Hapus</a></td>
        <?php else : ?>
            <td align="center"><a href="editPeminjaman.php?id_transaksi_pinjam_buku=<?=$row['id_transaksi_pinjam_buku'];?>">Edit</a> | <a href="hapusPeminjaman.php?id_transaksi_pinjam_buku=<?=$row['id_transaksi_pinjam_buku'];?>" onclick="return confirm('Yakin Kawan?')">Hapus</a></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>