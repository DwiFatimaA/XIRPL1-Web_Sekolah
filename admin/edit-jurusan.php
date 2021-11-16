<?php include 'header.php' ?>

<?php
    $jurusan = mysqli_query($conn, "SELECT * FROM jurusan WHERE id = '".$_GET['id']."' ");

    if(mysqli_num_rows($jurusan) == 0){
        echo "<script>window.location='jurusan.php'</script>";
    }

    $p = mysqli_fetch_object($jurusan);
?>

    <!--- Content --->
    <div class="content">
    <div class="container">
        <div class="box">
            <div class="box-header">
                Edit Jurusan
            </div>
            <div class="box-body">

            <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" placeholder="Nama Jurusan" value="<?= $p-> nama ?>" class="input-control" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea nama="keterangan" class="input-control" placeholder="Keterangan"><?= $p-> keterangan ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Gambar</label>
                        <img src="../uploads/jurusan/<? = $p-> gambar ?>" width="200px" class="image">
                        <input type="hidden" name="gambar2" value="<?= $p-> gambar ?>">
                        <input type="file" name="gambar" class="input-control">
                    </div>

                    <button type="button" class="button" onclick="window.location = 'jurusan.php'">Kembali</button>
                    <input type="submit" name="submit" value="Simpan" class="button button-grey">

            </form>
                
                <?php

                if(isset($_POST['submit'])){

                    $nama = addslashes(ucwords($_POST['nama']));
                    $ket = addslashes($_POST['keterangan']);
                    $currdate = date('Y-m-d H:i:s');

                    if($_FILES['gambar']['name'] !=''){
                        echo 'user ganti gambar';

                        $filename = $_FILES['gambar']['name'];
                        $tempname = $_FILES['gambar']['tmp_name'];
                        $filesize = $_FILES['gambar']['size'];

                        $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                        $rename = 'jurusan'.time().'.'.$formatfile;

                        $allowedtype = array('png', 'jpg', 'jpeg', 'gif');

                        if(file_exists("../uploads/jurusan/".$_POST['gambar2'])){
                            unlink("../uploads/jurusan/".$_POST['gambar2']);
                        }
                        

                        move_uploaded_file($tmpname, "../uploads/jurusan/".$rename);

                    }else{
                        echo 'user tidak ganti gambar';

                        $rename = $_POST['gambar2'];
                    }

                    $update = mysqli_query($conn, "UPDATE jurusan SET
                        nama = '".$nama."',
                        keterangan = '".$ket."',
                        gambar = '".$rename."',
                        updated_at = '".$currdate."'
                        WHERE id = '".$_GET['id']."'
                    
                    ");

                    if($update){
                        echo "<script>window.location='jurusan.php?success=Edit Data Berhasil'</script>";
                    }else{
                        echo 'Gagal Edit Data '.mysqli_error($conn);
                    }
                }

                ?>

            </div>
    </div>
    </div>
    </div>

<?php include 'footer.php' ?>