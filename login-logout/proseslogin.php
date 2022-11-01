<?php
session_start();
require_once("../utils/connect.php");
//Kita akan membuat proses login nya disini
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    if ($username == "" or $password == "") {
        echo "<script>alert('Username atau Password kosong');location.href='login.php';</script>";
    }else{
    $password = md5($password);
    $query = "SELECT * FROM petugas WHERE username='$username' AND password='$password' AND level='$level' ";
    $cari = mysqli_query($conn, $query);
    $hasil = mysqli_fetch_assoc($cari);
        // Jika data yang dicari kosong
        if(mysqli_num_rows($cari) == 0){
            echo "<script>alert('Username belum terdaftar!');location.href='login.php';</script>";
        }else{
            // Jika password tidak sesuai dengan yang ada di database
            if($hasil['password'] <> $password){
                echo "<script>alert('Password Salah!');location.href='login.php';</script>";
            }else{
                // Jika user sesuai dengan database maka akan redirect ke halaman utama dan akan dibuatkan sesi
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['level'] = $hasil['level'];
                header("location: ./../index.php");
            }
        }
    }
}
?>
