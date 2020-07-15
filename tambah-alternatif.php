<?php
include './includes/api.php';
akses_pengguna(array(1));

if (!empty($_POST)) {
    $pesan_error = array();
    $nama = $_POST['nama'];
    if ($nama == '') array_push($pesan_error, 'Nama Alternatif tidak boleh kosong');
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $periode = $_POST['periode'];
    if (empty($pesan_error)) {
        $q = $conn->prepare("INSERT INTO alternatif VALUE (NULL, '$nama', '$alamat', '$telp', '$periode')");
        $q->execute();
        header('Location: ./data-alternatif');
    }
}
include './includes/header.php';
?>
<h5><span class="fas fa-plus-circle"></span> Tambah Alternatif</h1>
    <hr>
    <form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
        <label class="mr-sm-2" for="nama">Nama Alternatif</label>
        <input id="nama" name="nama" class="form-control mb-2 mr-sm-2" type="text">
        <label class="mr-sm-2" for="alamat">Alamat</label>
        <input id="alamat" name="alamat" class="form-control mb-2 mr-sm-2" type="text">
        <label class="mr-sm-2" for="telp">No. Telp</label>
        <input id="telp" name="telp" class="form-control mb-2 mr-sm-2" type="text">
        <label class="mr-sm-2" for="periode">Periode</label>
        <input id="periode" name="periode" class="form-control mb-2 mr-sm-2" type="text">
        <button class="btn btn-primary" type="submit"><span class="fas fa-plus-circle"></span> Tambah</button>
        <button class="btn btn-danger" type="reset" onclick="location.href='./data-alternatif'"><span class="fas fa-times"></span> Batal</button>
        <?php if (!empty($pesan_error)) {
            echo '<hr><div class="alert alert-dismissable alert-danger"><ul>';
            foreach ($pesan_error as $x) {
                echo '<li>' . $x . '</li>';
            }
            echo '</ul></div>';
        }
        ?>
    </form>
    <?php include './includes/footer.php'; ?>