<?php

include '../koneksi.php';

if (isset($_GET['idpengguna'])){

    $delete = mysqli_query($conn, "DELETE FROM pengguna WHERE id = '".$_GET['idpengguna']."' ");

    echo "<script>window.location = 'pengguna.php'</script>";
}

if (isset($_GET['idjurusan'])){
    $jurusan = mysqli_query($conn, "SELECT gambar FROM jurusan WHERE id = '".$_GET['idjurusan']."' ");

    if(mysqli_num_rows($jurusan) > 0){
        $p = mysqli_fetch_object($jurusan);
        if(file_exists("../uploads/jurusan/".$p->gambar)){
            unlink("../uploads/jurusan/".$p->gambar);
        }
    }

    $delete = mysqli_query($conn, "DELETE FROM jurusan WHERE id = '".$_GET['idjurusan']."' ");
    echo "<script>window.location = 'jurusan.php'</script>";
}

?>