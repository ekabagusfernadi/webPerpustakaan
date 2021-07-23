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
    GROUP BY transaksi_pinjam_buku.kode_buku
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
    GROUP BY transaksi_pinjam_buku.no_anggota
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
    <?php if( $key == "bukuTerpopuler" ) : ?>
        <th>Kode Buku</th>
        <th>Judul Buku</th>
        <th>Telah Dipinjam Sebanyak</th>
    <?php else : ?>
        <th>No Anggota</th>
        <th>Nama Anggota</th>
        <th>Telah Pinjam Sebanyak</th>
    <?php endif; ?>
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
        <?php if( $key == "bukuTerpopuler" ) : ?>
            <td><?= $row["kode_buku"]; ?></td>
            <td><?= $row["judul_buku"]; ?></td>
            <td><?= $row["telah_dipinjam_sebanyak"]; ?></td>
            <td align="center"><a href="../ajax/detailPeminjaman.php?kode_buku=<?=$row['kode_buku'];?>">Detail</a></td>
        <?php else : ?>
            <td><?= $row["no_anggota"]; ?></td>
            <td><?= $row["nama_anggota"]; ?></td>
            <td><?= $row["telah_pinjam_sebanyak"]; ?></td>
            <td align="center"><a href="../ajax/detailPeminjaman.php?no_anggota=<?=$row['no_anggota']?>">Detail</a></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<!-- <script>
    // let tombolDetail = document.getElementById("tombol-detail");
    // tombolDetail.addEventListener("click", function () {
    //     // let xhr = new XMLHttpRequest();

    //     // xhr.onreadystatechange = function () {
    //     //   if (xhr.readyState == 4 && xhr.status == 200) {
    //     //     containerTable.innerHTML = xhr.responseText;
    //     //   }
    //     // };

    //     // xhr.open("GET", "../ajax/bukuTerpopulerAjax.php?key=anggotaTeraktif", true); // false = syncronus,true = asyncronus
    //     // xhr.send();
    // console.log("tes");
    // });
    console.log("tes");
</script> -->