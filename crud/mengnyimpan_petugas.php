<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/spp/utils/connect.php";
require($path);
// Proses Simpan
$user = $_POST['user'];
$pass = $_POST['pass'];
$nama = $_POST['nama'];
$level = $_POST['level'];

//check if data is empty or not
if(empty($user) || empty($pass) || empty($nama)){
    echo "<script>alert('Data tidak boleh kosong !');location.href='tambah_petugas.php';</script>";
}else{
    $hashedPass = md5($pass);
    $query = "INSERT INTO petugas VALUES(NULL, '$user', '$hashedPass', '$nama', '$level')";
    $simpan = mysqli_query($conn, $query);
    $num = mysqli_affected_rows($conn);

    if($num > 0){
        echo "<script>alert('Data tersimpan !');location.href='petugas.php'</script>";
    }else{
        $error = mysqli_error($conn);
        echo $error;
        echo "<script>alert('Data gagal disimpan : '$error' !');location.href='tambah_petugas.php'</script>";
    }
}

?>