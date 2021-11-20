<?php include 'header.php'; ?>

    <div class="section">
        <div class="container">
        <h3 class="text-center">Jurusan</h3>
        <?php
            $jurusan = mysqli_query($conn, "SELECT * FROM jurusan ORDER BY id DESC");
            if(mysqli_num_rows($jurusan) > 0){
                while($j = mysqli_fetch_array($jurusan)){
        ?>

        <div class="col-4">
            <a href="detail-jurusan.php?id=<?= $j['id'] ?>" class="thumbnail-link">
            <div class="thumbnail-box">
                <div class="thumbnail-img" style="background-image: url('uploads/jurusan/<?= $j['gambar']?>');">
                </div>
                    <div class="thumbnail-text">
                        <?= $j['nama']?>
                    </div>
            </div>
                </a>
        </div>

        <?php }}else{ ?>
            Tidak ada data
        <?php } ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>