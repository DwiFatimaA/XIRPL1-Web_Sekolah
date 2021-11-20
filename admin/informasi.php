<?php include 'header.php' ?>

    <!--- Content --->
    <div class="content">
    <div class="container">
        <div class="box">
            <div class="box-header">
                Informasi
            </div>
            <div class="box-body">

                <a href="tambah-informasi.php"><i class="fa fa-plus"></i>Tambah</a>

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
                            <th>Judul</th>
                            <th>Keterangan</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $no = 1;

                        $where = " WHERE 1=1 ";
                        if(isset($_GET['key'])){
                            $where .= " AND judul LIKE '%".addslashes($_GET['key'])."%' ";
                        }

                        $informasi = mysqli_query($conn, "SELECT * FROM informasi $where ORDER BY id DESC");
                        if(mysqli_num_rows($informasi) > 0){
                            while($p = mysqli_fetch_array($informasi)){
                        ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $p['judul'] ?></td>
                            <td><?= substr($p['keterangan'], 0, 50) ?></td>
                            <td><img src="../uploads/informasi/<?= $p['gambar'] ?>" width="100px"></td>
                            <td>
                                <a href="edit-informasi.php?id=<?= $p['id'] ?>" title="Edit Data" class="text-black"><i class="fa fa-edit"></i></a> 
                                <a href="hapus.php?idinformasi=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin hapus?')" title="Hapus Data" class="text-red"><i class="fa fa-times"></i></a>
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