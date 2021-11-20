<?php include 'header.php' ?>

    <!--- Content --->
    <div class="content">
    <div class="container">
        <div class="box">
            <div class="box-header">
                Tambah Galeri
            </div>
            <div class="box-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" placeholder="Keterangan" class="input-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="input-control" required>
                    </div>

                    <button type="button" class="button" onclick="window.location = 'galeri.php'">Kembali</button>
                    <input type="submit" name="submit" value="Simpan" class="button button-grey">

                </form>

                <?php

                if(isset($_POST['submit'])){

                    // print_r($_FILES['gambar']);

                    $ket = addslashes(ucwords($_POST['keterangan']));

                    $filename = $_FILES['gambar']['name'];
                    $tmpname  = $_FILES['gambar']['tmp_name'];
                    $filesize = $_FILES['gambar']['size'];

                    $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                    $rename     = 'galeri'.time().'.'.$formatfile;

                    $allowedtype = array('png', 'jpg', 'jpeg', 'gif');

                    if(!in_array($formatfile, $allowedtype)){
                        echo '<div class="alert alert-eror">Format file tidak diizinkan</div>';
                    }elseif($filesize > 2000000){
                        echo '<div class="alert alert-eror">Ukuran file tidak boleh lebih dari 2 MB</div>';
                    }else{

                        move_uploaded_file($tmpname, "../uploads/galeri/".$rename);

                        $simpan = mysqli_query($conn, "INSERT INTO galeri VALUES (
                            null,
                            '".$rename."',
                            '".$ket."',
                            null,
                            null
                        )");
    
                        if($simpan){
                            echo '<div class="alert alert-success">Simpan Berhasil</div>';
                        }else{
                            echo 'Gagal Menyimpan '.mysqli_error($conn);
                        }
                    }

                }

                ?>
            </div>
    </div>
    </div>
    </div>

<?php include 'footer.php' ?>