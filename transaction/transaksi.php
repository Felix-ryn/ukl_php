<?php
require_once("../misc/require.php");
$connectpath = $_SERVER['DOCUMENT_ROOT'];
    $connectpath .= "/spp/utils/connect.php";
    include($connectpath);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/spp/Styles/table.css">
    <meta charset="UTF-8">
    <title>Entry Transaksi</title>
</head>
<body>
    <!-- Panggil script header -->
    <?php require_once("../misc/header.php"); ?>
    <!-- Isi Konten -->
    <div class="all-table">
    <h3>Transaksi</h3>
    <p><button type="button" class="btn btn-outline-secondary"><a href="/spp/crud/tambah_transaksi.php">Tambah Data</a></button></p>
    <table class="table  table-hover table-dark" cellspacing="1">
        <tr>
            <td>No. </td>
            <td>Nama Petugas</td>
            <td>Nama Siswa</td>
            <td>Tgl/Bulan/Tahun dibayar</td>
            <td>bulan / Nominal harus dibayar</td>
            <td>Jumlah yang dibayar</td>
            <td>Status</td>
            <td>Aksi</td>
            <td>sisa</td>
        </tr>
<?php
$totalDataHalaman = 5;
$data = mysqli_query($conn, "SELECT * FROM pembayaran");
$hitung = mysqli_num_rows($data);
$totalHalaman = ceil($hitung / $totalDataHalaman);
$halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
$dataAwal = ($totalDataHalaman * $halAktif) - $totalDataHalaman;
// Kita panggil tabel pembayaran
// Setelah kita panggil, JOIN tabel yang ter relasi ke tabel pembayaran
$sql = mysqli_query($conn, "SELECT * FROM pembayaran
JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
JOIN siswa ON pembayaran.nisn = siswa.nisn
JOIN spp ON pembayaran.id_spp = spp.id_spp
ORDER BY tgl_bayar ASC LIMIT $dataAwal, $totalDataHalaman");
$no = 1;
while($r = mysqli_fetch_assoc($sql)){ ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $r['nama_petugas']; ?></td>
            <td><?= $r['nama']; ?></td>
            <td><?= $r['tgl_bayar'] . "/" . $r['bulan_spp'] . "/" . $r['tahun_spp']; ?></td>
            <td><?= $r['bulan'] . " | Rp. " . $r['nominal']; ?></td>
            <td><?= $r['jumlah_bayar']; ?></td>
            <td>
<?php
// Jika jumlah bayar sesuai dengan yang harus dibayar maka Status LUNAS
if($r['jumlah_bayar'] >= $r['nominal']){ ?>
                <font style="color: aqua; font-weight: bold;">LUNAS</font>
<?php }else{ ?>                           <font style="color: tomato; font-weight: bold;">  BELUM LUNAS </font> <?php } ?> 
</td>


<td>
<?php
// button bayar lunas
// Jika siswa ingin membayar lunas sisa pembayaran
if($r['jumlah_bayar'] >= $r['nominal']){ echo "-";
}else{ ?>
    <a href="?lunas&id=<?= $r['id_pembayaran']; ?>">BAYAR LUNAS</a>
<?php } 
$sisa =  $r['jumlah_bayar'] - $r['nominal'] ;
// button bayar lunas?> 
</td>

<td>
    <?= $sisa; //tampilken sisa pembayaran ?>
</td>

        </tr>
<?php $no++; } ?>
    </table>
<!-- Tampilkan tombol halaman -->
<div class="table-number">
<?php for($i=1; $i <= $totalHalaman; $i++): ?>
        <a href="?hal=<?= $i; ?>"><?= $i; ?></a>
<?php endfor; ?>
</div>
<!-- Selesai -->
    </div>
    <?php 
    $footerpath = $_SERVER['DOCUMENT_ROOT'];
    $footerpath .= "/spp/misc/footer.php"; 
    require($footerpath); ?>
</body>
</html>
<?php
// Ada siswa yang ingin membayar sisa pembayaran
if(isset($_GET['lunas'])){
    $id = $_GET['id'];
    $ambilData = mysqli_query($conn, "SELECT * FROM pembayaran JOIN spp ON pembayaran.id_spp=spp.id_spp 
                                    WHERE id_pembayaran = '$id'");
    $row = mysqli_fetch_assoc($ambilData);
    $hasil = $row['jumlah_bayar'] + ($sisa * -1);
    $update = mysqli_query($conn, "UPDATE pembayaran SET jumlah_bayar='$hasil' WHERE id_pembayaran='$id'");
    if($update){
        echo "<script>alert('Data Berhasil Ditambahkan !');location.href='../transaction/transaksi.php';</script>";
    }
}
?>