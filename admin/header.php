<?php
session_start();
include '../koneksi.php';
if(!isset($_SESSION['status_login'])){
    echo "<script>window.location = '../login.php?msg=Harap Login Terlebih Dahulu'</script>";
}

date_default_timezone_set("Asia/Jakarta");

$identitas = mysqli_query($conn, "SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
$d = mysqli_fetch_object($identitas);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="../uploads/identitas/<?= $d->favicon ?>">
        <title>Panel Admin - <?= $d->nama ?></title>
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
      tinymce.init({
        selector: '#keterangan'
      });
    </script>

    </head>
    <body class="bg-light">
        <!--- Navbar -->
        <div class="navbar">
        
        <div class="container">
        
        <!--- Navbar Brand --->
        <h3 class="nav-brand float-left"><a href="index.php"><?= $d->nama ?></a></h3>

        <!--- Navbar Menu--->
        <ul class="nav-menu float-left">
            <li><a href="index.php">Dashboard</a></li>

            <?php if($_SESSION['ulevel'] == 'Super Admin'){ ?>
                <li><a href="pengguna.php">Pengguna</a></li>
            <?php }elseif($_SESSION['ulevel'] == 'Admin'){ ?>

                <li><a href="jurusan.php">Jurusan</a></li>
                <li><a href="galeri.php">Galeri</a></li>
                <li><a href="informasi.php">Informasi</a></li>
                <li>
                    <a href="#">Pengaturan<i class="fa fa-caret-down"></i></a>

                    <!--- Sub Menu--->
                    <ul class="dropdown">
                        <li><a href="identitas-sekolah.php">Identitas Sekolah</a></li>
                        <li><a href="tentang-sekolah.php">Tentang Sekolah</a></li>
                        <li><a href="kepala-sekolah.php">Kepala Sekolah</a></li>
                    </ul>
                </li>

                <?php } ?>

            <li>
                <a href="#">Akun<i class="fa fa-caret-down"></i></a>

                <!--- Sub Menu--->
                <ul class="dropdown">
                    <li><a href="ubah-password.php">Ubah Password</a></li>
                    <li><a href="logout.php">Keluar</a></li>
                </ul>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    </div>