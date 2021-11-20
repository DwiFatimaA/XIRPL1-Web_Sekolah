<?php include 'header.php' ?>

    <!--- Content --->
    <div class="content">
    <div class="container">
        <div class="box">
            <div class="box-header">
                Identitas Sekolah
            </div>
            <div class="box-body">

            <?php
                    if(isset($_GET['success'])){
                        echo "<div class='alert alert-success'>".$_GET['success']."</div>";
                    }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" placeholder="Nama Sekolah" value="<?= $d->nama ?>" class="input-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email Sekolah" value="<?= $d->email ?>" class="input-control" required>
                    </div>

                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telp" placeholder="Telepon Sekolah" value="<?= $d->telepon ?>" class="input-control" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="input-control" placeholder="Alamat"><?= $d->alamat ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Google Maps</label>
                        <textarea name="gmaps" class="input-control" placeholder="Google Maps"><?= $d->google_maps ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Logo</label>
                        <img src="../uploads/identitas/<?= $d->logo ?>" width="200px" class="image">
                        <input type="hidden" name="logo_lama" value="<?= $d->logo ?>">
                        <input type="file" name="logo_baru" class="input-control">
                    </div>

                    <div class="form-group">
                        <label>Favicon</label>
                        <img src="../uploads/identitas/<?= $d->favicon ?>" width="50px" class="image">
                        <input type="hidden" name="favicon_lama" value="<?= $d->favicon ?>">
                        <input type="file" name="favicon_baru" class="input-control">
                    </div>

                    <input type="submit" name="submit" value="Simpan Perubahan" class="button button-grey">

                </form>

                <?php

                if(isset($_POST['submit'])){

                    $nama = addslashes(ucwords($_POST['nama']));
                    $email  = addslashes($_POST['email']);
                    $telp  = addslashes($_POST['telp']);
                    $alamat  = addslashes($_POST['alamat']);
                    $gmaps  = addslashes($_POST['gmaps']);
                    $currdate = date('Y-m-d H:i:s');

                    //Menampung dan validasi data logo
                    if($_FILES['logo_baru']['name'] != ''){

                        $filename_logo = $_FILES['logo_baru']['name'];
                        $tmpname_logo  = $_FILES['logo_baru']['tmp_name'];
                        $filesize_logo = $_FILES['logo_baru']['size'];
    
                        $formatfile_logo = pathinfo($filename_logo, PATHINFO_EXTENSION);
                        $rename_logo     = 'logo'.time().'.'.$formatfile_logo;
    
                        $allowedtype_logo = array('png', 'jpg', 'jpeg', 'gif');

                        if(!in_array($formatfile_logo, $allowedtype_logo)){

                            echo '<div class="alert alert-eror">Format file logo tidak diizinkan</div>';
                            return false;

                        }elseif($filesize_logo > 2000000){

                            echo '<div class="alert alert-eror">Ukuran file logo tidak boleh lebih dari 2 MB</div>';
                            return false;

                        }else{

                        if(file_exists("../uploads/identitas/".$_POST['logo_lama'])){
                            unlink("../uploads/identitas/".$_POST['logo_lama']);
                        }

                        move_uploaded_file($tmpname_logo, "../uploads/identitas/".$rename_logo);

                    }

                    }else{

                        $rename_logo = $_POST['logo_lama'];
                    }

                    //Menampung dan validasi data favicon
                    if($_FILES['favicon_baru']['name'] != ''){

                        $filename_favicon = $_FILES['favicon_baru']['name'];
                        $tmpname_favicon  = $_FILES['favicon_baru']['tmp_name'];
                        $filesize_favicon = $_FILES['favicon_baru']['size'];
    
                        $formatfile_favicon = pathinfo($filename_favicon, PATHINFO_EXTENSION);
                        $rename_favicon     = 'favicon'.time().'.'.$formatfile_favicon;
    
                        $allowedtype_favicon = array('png', 'jpg', 'jpeg', 'gif');

                        if(!in_array($formatfile_favicon, $allowedtype_favicon)){

                            echo '<div class="alert alert-eror">Format file favicon tidak diizinkan</div>';
                            return false;

                        }elseif($filesize_favicon > 2000000){

                            echo '<div class="alert alert-eror">Ukuran file favicon tidak boleh lebih dari 2 MB</div>';
                            return false;

                        }else{

                        if(file_exists("../uploads/identitas/".$_POST['favicon_lama'])){
                            unlink("../uploads/identitas/".$_POST['favicon_lama']);
                        }

                        move_uploaded_file($tmpname_favicon, "../uploads/identitas/".$rename_favicon);

                    }

                    }else{

                        $rename_favicon = $_POST['favicon_lama'];
                    }

                $update = mysqli_query($conn, "UPDATE pengaturan SET
                    nama = '".$nama."',
                    email = '".$email."',
                    telepon = '".$telp."',
                    alamat = '".$alamat."',
                    google_maps = '".$gmaps."',
                    logo = '".$rename_logo."',
                    favicon = '".$rename_favicon."',
                    updated_at = '".$currdate."'
                    WHERE id = '".$d->id."'
                
                    ");

                if($update){
                    echo "<script>window.location='identitas-sekolah.php?success=Edit Data Berhasil'</script>";
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