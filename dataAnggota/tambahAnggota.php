<?php
require "../config.php";

if( isset($_POST["submit"]) ) {
    $namaAnggotaBaru = $_POST["namaAnggota"];
    $kodeTanggalInputan = date("Ymd");
    $urutanInputan = 1;
    
    // ambil database
    $query = "SELECT no_anggota FROM data_anggota";
    $result = mysqli_query($conn, $query);

    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row; 
    }

    foreach( $rows as $row ) {
        // pisah kodeTanggalDB dan urutanDB
        $noAnggotaDBPreg = preg_split('//', $row["no_anggota"]);
        $kodeTanggalDB = $noAnggotaDBPreg[1] . $noAnggotaDBPreg[2] . $noAnggotaDBPreg[3] . $noAnggotaDBPreg[4] . $noAnggotaDBPreg[5] . $noAnggotaDBPreg[6] . $noAnggotaDBPreg[7] . $noAnggotaDBPreg[8];
        $urutanDB = $noAnggotaDBPreg[9] . $noAnggotaDBPreg[10] . $noAnggotaDBPreg[11];

        // kondisi
        if( $kodeTanggalInputan == $kodeTanggalDB ) {
            $urutanInputan = $urutanDB + 1;
        }
        
    }

    // sambung no_anggota
    $noAnggotaBaru = $kodeTanggalInputan . sprintf("%03s", $urutanInputan);

    // insert ke database
    mysqli_query($conn, "INSERT INTO data_anggota(no_anggota, nama_anggota) VALUES ('$noAnggotaBaru', '$namaAnggotaBaru')");
    // header("Location: dataAnggota.php");
    echo    "<script>
	        alert('Data Berhasil Ditambahkan');
	        document.location.href = 'dataAnggota.php';
        </script>";

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Anggota</title>
</head>
<body class="">
	<header id="header">
		<div class="container">
			<center>
                <a href="../index.php"><img src="../kijangPerpus.png" alt="kijang-nich" width="50"></a>
				<h1>
					Tambah Anggota
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
                        	<label for="namaAnggota">Nama Anggota </label>	
                        </td>
                        <td>
                        	: <input type="text" name="namaAnggota" id="namaAnggota" required>	
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