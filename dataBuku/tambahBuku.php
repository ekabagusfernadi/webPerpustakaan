<?php
require "../config.php";

if( isset($_POST["submit"]) ) {

    // ambil 2 huruf awal dari inputan judul buku
    $judulBukuInputan = $_POST["judulBuku"];
    $pregSplitJudulBukuInputan = preg_split('//', $judulBukuInputan);
    $inisialJudulBukuInputan = $pregSplitJudulBukuInputan[1] . $pregSplitJudulBukuInputan[2];
    $inisialJudulBukuInputan = strtoupper($inisialJudulBukuInputan);

    // ambil data kode_buku dari tabel data_buku
    $result = mysqli_query($conn, "SELECT kode_buku FROM data_buku");
    
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    
    // cek apakah inisial kode inputan sama dengan inisial didatabase
    
    $nomorKodeBukuBaru = 1; // inisialisasi nomor kode buku baru
    foreach ($rows as $row) {
        // pisahkan inisial dan nomor tiap2 kode buku di database
        $pregSplitKodeBukuDB = preg_split('/-/', $row["kode_buku"]);
        $inisialJudulBukuDB = $pregSplitKodeBukuDB[0];
        $nomorKodeBukuDB = $pregSplitKodeBukuDB[1];

        if ($inisialJudulBukuInputan == $inisialJudulBukuDB) {
            // jika inisial inputan == inisial judul buku di database nomor kode buku baru = nomor kode buku didatabase + 1
            $nomorKodeBukuBaru = $nomorKodeBukuDB + 1;
        }
        
        
    }
    // sambungkan inisial dan nomor kode buku baru
    $kodeBukuBaru = $inisialJudulBukuInputan . "-" . sprintf("%03s", $nomorKodeBukuBaru);
    
    // insert ke database (data_buku)
    mysqli_query($conn, "INSERT INTO data_buku(kode_buku, judul_buku) VALUES ('$kodeBukuBaru', '$judulBukuInputan')");
    // insert ke database (data_buku_tersedia)
    mysqli_query($conn, "INSERT INTO data_buku_tersedia(kode_buku, judul_buku) VALUES ('$kodeBukuBaru', '$judulBukuInputan')");
    // header("Location: dataBuku.php");
    echo    "<script>
	        alert('Data Berhasil Ditambahkan');
	        document.location.href = 'dataBuku.php';
        </script>";

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Buku</title>
</head>
<body class="">
	<header id="header">
		<div class="container">
			<center>
                <a href="../index.php"><img src="../kijangPerpus.png" alt="kijang-nich" width="50"></a>
				<h1>
					Tambah Buku
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
                        	<label for="judulBuku">Judul Buku </label>	
                        </td>
                        <td>
                        	: <input type="text" name="judulBuku" id="judulBuku" required>	
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
</body>
</html>