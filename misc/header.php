<!-- ADMIN DAPAT MENGAKSES SEMUANYA -->
<?php
$username = $_SESSION['username'];
?>

<html>
    <head>   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Styles/table.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/spp/Styles/header.css">        
        
    </head>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/spp/utils/connect.php";
    include($path);
    $panggil = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username'");
    $hasil = mysqli_fetch_assoc($panggil);    
    ?>
    
<nav class="navbar navbar-expand-lg navbar-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item ml-auto">
        <a class="nav-link usrname" href="/spp/index.php"> <?php echo $hasil['username']; ?></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link nav-link-active" href="/spp/index.php">Home</a>
      </li>
      <?php
      if($hasil['level'] == "admin"){ 
      ?>

      <li class="nav-Item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkSis" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Data Master 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkSis">
          <a class="dropdown-item" href="/spp/crud/siswa.php">Data Siswa</a>
          <a class="dropdown-item" href="/spp/crud/kelas.php">Data Kelas</a>
          <a class="dropdown-item" href="/spp/crud/spp.php">Data SPP</a>
          <a class="nav-link" href="/spp/crud/petugas.php">Data Petugas</a>
        </div>
      </li>

      <li class="nav-Item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkSPP" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Transaksi
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkSPP">
        <a class="dropdown-item" href="/spp/transaction/transaksi.php">Transaksi</a>
        <a class="dropdown-item" href="/spp/misc/history.php">History Pembayaran</a>
        </div>
      </li>

   
      <?php
        }else { ?>

      <li class="nav-item">
        <a class="nav-link" href="/spp/transaction/transaksi.php">Transaksi</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/spp/misc/history.php">History Pembayaran</a>
      </li>      
    <?php } ?>
    <li class="nav-item">
        <a class="nav-link logout" href="/spp/login-logout/logout.php">LogOut</a>
      </li>
    </ul>
    
  </div>
</nav>
</html>