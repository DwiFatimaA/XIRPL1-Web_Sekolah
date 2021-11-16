<?php include 'header.php' ?>

    <!--- Content --->
    <div class="content">
    <div class="container">
        <div class="box">
            <div class="box-header">
                Ubah Password
            </div>
            <div class="box-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass1" placeholder="Password" class="input-control" required>
                    </div>

                    <div class="form-group">
                        <label>Ulangi Password</label>
                        <input type="password" name="pass2" placeholder="Ulangi Password" class="input-control" required>
                    </div>

                    <input type="submit" name="submit" value="Ubah Password" class="button button-grey">

                </form>

                <?php

                if(isset($_POST['submit'])){
                    $pass1 = addslashes($_POST['pass1']);
                    $pass2 = addslashes($_POST['pass2']);
                    $currdate = date('Y-m-d H:i:s');

                    if($pass2 != $pass1){
                        echo '<div class="alert alert-eror">Password tidak sesuai!</div>';
                    }else{
                        $update = mysqli_query($conn, "UPDATE pengguna SET
                        password = '".md5($pass1)."',
                        updated_at = '".$currdate."'
                        WHERE id = '".$_SESSION['uid']."'
                    
                    ");

                    if($update){
                        echo '<div class="alert alert-success">Ubah Password Berhasil</div>';
                    }else{
                        echo 'Gagal Edit Data '.mysqli_error($conn);
                    }
                    }
                }

                ?>

            </div>
    </div>
    </div>
    </div>

<?php include 'footer.php' ?>