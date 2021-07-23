<?php
require "../config.php";

$id = $_GET["no_anggota"];
$query = "SELECT * FROM data_anggota WHERE no_anggota = '$id'";
$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

if( isset($_POST["submit"]) ) {

    $namaAnggotaUpdate = $_POST["namaAnggota"];
    // update database
    mysqli_query($conn, "UPDATE data_anggota SET
        nama_anggota = '$namaAnggotaUpdate'
        WHERE no_anggota = '$id'
    ");
    // header("Location: dataAnggota.php");
    echo    "<script>
	        alert('Data Berhasil Diedit');
	        document.location.href = 'dataAnggota.php';
        </script>";

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota</title>
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
                            <label for="namaAnggota">Nama Anggota</label>  
                        </td>
                        <td>
                            : <input type="text" name="namaAnggota" id="namaAnggota" value="<?= $data['nama_anggota'];?>" required>   
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