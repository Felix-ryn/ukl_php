<?php
require_once("../misc/require.php");
$connectpath = $_SERVER['DOCUMENT_ROOT'];
    $connectpath .= "/spp/utils/connect.php";
    include($connectpath);
    if($_SESSION['level']!="admin"){
        header("location: ./../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>     
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/spp/Styles/table.css">
    <meta charset="UTF-8">
    <title>Data SPP</title>
</head>
<body>
    <!-- Panggil script header -->
    <?php require_once("../misc/header.php"); ?>
    <!-- Isi Konten -->
    <div class="all-table">
    <h3>SPP</h3>
    <p><a href="../crud/tambah_spp.php"><button type="button" class="btn btn-outline-secondary">Tambah Data Spp</button></a></p>
    
    <table class="table  table-hover table-dark" cellspacing="0" border="1" cellpadding="5">
        <tr>
            <td>No. </td>
            <td>Bulan</td>
            <td>Id SPP </td>
            <td>Angkatan </td>
            <td>Nominal</td>
            <td>Aksi</td>
        </tr>
<?php
// Kita Konfigurasi Pagging disini
$totalDataHalaman = 5;
$data = mysqli_query($conn, "SELECT * FROM spp");
$hitung = mysqli_num_rows($data);
$totalHalaman = ceil($hitung / $totalDataHalaman);
$halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
$dataAwal = ($totalDataHalaman * $halAktif) - $totalDataHalaman;
// Konfigurasi Selesai
// Kita panggil tabel spp
$sql = mysqli_query($conn, "SELECT * FROM spp ORDER BY bulan ASC LIMIT $dataAwal, $totalDataHalaman");
$no = 1;
while($r = mysqli_fetch_assoc($sql)){ ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $r['bulan']; ?></td>
            <td><?= $r['id_spp']; ?></td>
            <td><?= $r['angkatan']; ?></td>
            <td><?= "Rp. " . $r['nominal']; ?></td>
            <td><a href="?hapus&id=<?= $r['id_spp']; ?>">Hapus</a> | 
                <a href="edit_spp.php?id=<?= $r['id_spp']; ?>">Edit</a></td>
        </tr>
<?php $no++; } ?>
    </table>
<!-- Tampilkan tombol halaman -->
<div class="table-number">
<?php for($i=1; $i <= $totalHalaman; $i++): ?>
        <a href="?hal=<?= $i; ?>"><?= $i; ?></a>
<?php endfor; ?>
</div>
</div>
<!-- Selesai -->
    <?php 
    $footerpath = $_SERVER['DOCUMENT_ROOT'];
    $footerpath .= "/spp/misc/footer.php"; 
    require($footerpath); ?>
</body>
</html>
<?php
// Tombol Hapus ditekan
if(isset($_GET['hapus'])){
    $id = $_GET['id'];
    $hapus = mysqli_query($conn, "DELETE FROM spp WHERE id_spp='$id'");
    if($hapus){
        echo "<script>alert('Data Berhasil Dihapus !');location.href='spp.php';</script>";
    }else{
        echo "<script>alert('Maaf, data tersebut masih terhubung dengan data yang lain');
        </script>";
    }
}
?>