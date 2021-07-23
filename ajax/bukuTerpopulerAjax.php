<?php
require "../config.php";

$key = $_GET["key"];

if( $key == "bukuTerpopuler" ) {
    $queryPencarian = "SELECT transaksi_pinjam_buku.id_transaksi_pinjam_buku, transaksi_pinjam_buku.no_anggota, transaksi_pinjam_buku.kode_buku, transaksi_pinjam_buku.tanggal_pinjam_buku, transaksi_pinjam_buku.batas_pengembalian_buku, transaksi_pinjam_buku.status, data_anggota.nama_anggota, data_buku.judul_buku, tbl_jml_buku.telah_dipinjam_sebanyak
    FROM transaksi_pinjam_buku
    JOIN data_anggota ON(transaksi_pinjam_buku.no_anggota = data_anggota.no_anggota)
    JOIN data_buku ON(transaksi_pinjam_buku.kode_buku = data_buku.kode_buku)
    JOIN (SELECT COUNT(kode_buku) as telah_dipinjam_sebanyak, kode_buku
    FROM transaksi_pinjam_buku
    GROUP BY kode_buku) AS tbl_jml_buku ON(transaksi_pinjam_buku.kode_buku = tbl_jml_buku.kode_buku)
    ORDER BY tbl_jml_buku.telah_dipinjam_sebanyak DESC, data_buku.judul_buku ASC, transaksi_pinjam_buku.batas_pengembalian_buku ASC
";
} else if( $key == "anggotaTeraktif" ) {
    $queryPencarian = "SELECT transaksi_pinjam_buku.id_transaksi_pinjam_buku, transaksi_pinjam_buku.no_anggota, transaksi_pinjam_buku.kode_buku, transaksi_pinjam_buku.tanggal_pinjam_buku, transaksi_pinjam_buku.batas_pengembalian_buku, transaksi_pinjam_buku.status, data_anggota.nama_anggota, data_buku.judul_buku, tbl_jml_anggota.telah_pinjam_sebanyak
    FROM transaksi_pinjam_buku
    JOIN data_anggota ON(transaksi_pinjam_buku.no_anggota = data_anggota.no_anggota)
    JOIN data_buku ON(transaksi_pinjam_buku.kode_buku = data_buku.kode_buku)
    JOIN (SELECT COUNT(no_anggota) as telah_pinjam_sebanyak, no_anggota
    FROM transaksi_pinjam_buku
    GROUP BY no_anggota) AS tbl_jml_anggota ON(transaksi_pinjam_buku.no_anggota = tbl_jml_anggota.no_anggota)
    ORDER BY tbl_jml_anggota.telah_pinjam_sebanyak DESC, data_anggota.nama_anggota ASC, transaksi_pinjam_buku.batas_pengembalian_buku ASC
";
}

$objekQueryPencarian = mysqli_query($conn, $queryPencarian);

if ( mysqli_num_rows($objekQueryPencarian) > 0 ) {
    $rows = [];
    while ($row = mysqli_fetch_assoc($objekQueryPencarian)) {
        $rows[] = $row;
    }
} else {
    echo "Pencarian Tidak Ditemukan";
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
        <!-- <th>Telah Dipinjam Sebanyak</th> -->
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