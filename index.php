    <?php include 'header.php'; ?>
    
    <!--- Bagian Banner --->
    <div class="banner" style="background-image: url('uploads/identitas/<?= $d->foto_sekolah ?>');">
        <div class="banner-text">
            <div class="container">
            <h3>Selamat Datang di <?= $d->nama ?></h3>
            <p>Sekolah Menengah Kejuruan dengan 3 jurusan,
            yakni Rekayasa Perangkat Lunak, Teknik Jaringan Akses,
            dan Teknik Jaringan dan Komunikasi</p>
        </div>
        </div>
    </div>

    <!--- Bagian Sambutan --->
    <div class="section">
        <div class="container text-center">
            <h3>Sambutan Kepala Sekolah</h3>
            <img src="uploads/identitas/<?= $d->foto_kepsek ?>" width="100px">
            <h4><?= $d->nama_kepsek ?></h4>
            <p><?= $d->sambutan_kepsek ?></p>
        </div>
    </div>

    <!--- Bagian Jurusan --->
    <div class="section" id="jurusan">
    <div class="container text-center">
        <h3>Jurusan</h3>

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

    <!--- Bagian Infomasi --->
    <div class="section">
        <div class="container text-center">
            <h3>Informasi Terbaru</h3>

            <?php
            $informasi = mysqli_query($conn, "SELECT * FROM informasi ORDER BY id DESC LIMIT 8");
            if(mysqli_num_rows($informasi) > 0){
                while($p = mysqli_fetch_array($informasi)){
        ?>

        <div class="col-4">
            <a href="detail-informasi.php?id=<?= $p['id']?>" class="thumbnail-link">
            <div class="thumbnail-box">
                <div class="thumbnail-img" style="background-image: url('uploads/informasi/<?= $p['gambar']?>');">
                </div>
                    <div class="thumbnail-text">
                        <?= substr($p['judul'], 0, 50)?>
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