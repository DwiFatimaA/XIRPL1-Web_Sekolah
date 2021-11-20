<?php include 'header.php' ?>

    <!--- Content --->
    <div class="content">
    <div class="container">
        <div class="box">
            <div class="box-header">
                Pengguna
            </div>
            <div class="box-body">

                <a href="tambah-pengguna.php"><i class="fa fa-plus"></i>Tambah</a>

                <?php
                    if(isset($_GET['success'])){
                        echo "<div class='alert alert-success'>".$_GET['success']."</div>";
                    }
                ?>

                <form action="">
                    <div class="input-group">
                        <input type="text" name="key" placeholder="Pencarian">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $no = 1;

                        $where = " WHERE 1=1 ";
                        if(isset($_GET['key'])){
                            $where .= " AND nama LIKE '%".addslashes($_GET['key'])."%' ";
                        }

                        $pengguna = mysqli_query($conn, "SELECT * FROM pengguna $where ORDER BY id DESC");
                        if(mysqli_num_rows($pengguna) > 0){
                            while($p = mysqli_fetch_array($pengguna)){
                        ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $p['nama'] ?></td>
                            <td><?= $p['username'] ?></td>
                            <td><?= $p['level'] ?></td>
                            <td>
                                <a href="edit-pengguna.php?id=<?= $p['id'] ?>" title="Edit Data" class="text-black"><i class="fa fa-edit"></i></a> 
                                <a href="hapus.php?idpengguna=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin hapus?')" title="Hapus Data" class="text-red"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                        <?php }}else{ ?>
                            <tr>
                                <td colspan="5">Data tidak tersedia</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
    </div>
    </div>
    </div>

<?php include 'footer.php' ?>