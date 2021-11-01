<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>

<head>
        <title>Halaman Login</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>

    <!--- page login --->
    <div class="page-login"></div>

    <!--- box --->
    <div class="box box-login"></div>

    <!--- box header--->
    <div class="box-header text-center">
        Login
    </div>

    <!--- box body --->
    <div class="box-body">

        <!--- form login --->
        <form action="" method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="user" placeholder="Username" class="input-control">
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="pass" placeholder="Password" class="input-control">
            </div>

            <input type="submit" name="submit" value="Login" class="button"/>

        </form>

        <?php

        if(isset($_POST['submit'])){
            $user = $_POST['user'];
            $pass = $_POST['pass'];

            $cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '".$user."' ");
            if(mysqli_num_rows($cek) > 0){

                $d = mysqli_fetch_object($cek);
                if(md5($pass) == $d->password){

                $_SESSION['status_login'] = true;
                $_SESSION['uid'] = $d->id;
                $_SESSION['uname'] = $d->nama;
                $_SESSION['ulevel'] = $d->level;

                echo "<script>window.location = 'admin/index.php'</script>";


                }else{
                    echo'<div class="alert alert-eror">Password salah</div>';
                }

            }else{
                echo '<div class="alert alert-eror">Username tidak tersedia</div>';
            }
        }

        ?>

    </div>

    <!--- box footer --->
    <div class="box-footer text-center">
        <a href="index.php">Halaman Utama</a>
    </div>
        

</body>
    </html>