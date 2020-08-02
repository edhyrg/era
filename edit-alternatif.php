<?php
include './includes/api.php';
akses_pengguna(array(1));
if (!empty($_POST)) {
    $pesan_error = array();
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    if ($nama == '') array_push($pesan_error, 'Nama Alternatif tidak boleh kosong');
    if (empty($pesan_error)) {
        $q = $conn->prepare("UPDATE alternatif SET nama='$nama', alamat='$alamat' , telp='$telp' WHERE id_alternatif='$id'");
        $q->execute();
        ob_clean();
        header('Location: ./data-alternatif');
    }
} else if (!empty($_GET)) {
    @$id = $_GET['id'];
    $q = $conn->prepare("SELECT * FROM alternatif  WHERE alternatif.id_alternatif='$id'");
    $q->execute();
    @$data = $q->fetchAll()[0];
    if ($data) {
        $id = $data[0];
        $nama = $data[1];
        $alamat = $data[2];
        $telp = $data[3];
    } else header('Location: ./data-alternatif');
} else header('Location: ./data-alternatif');

include 'includes/header.php';
?>
<h5><span class="fas fa-pen"></span> Edit alternatif</h5>
<hr>
<form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label class="mr-sm-2" for="nama">Nama Alternatif</label>
    <input id="nama" name="nama" class="form-control mb-2 mr-sm-2" type="text">
    <label class="mr-sm-2" for="alamat">Alamat</label>
    <input id="alamat" name="alamat" class="form-control mb-2 mr-sm-2" type="text">
    <label class="mr-sm-2" for="telp">No. Telp</label>
    <input id="telp" name="telp" class="form-control mb-2 mr-sm-2" type="text">
    <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span> Simpan</button>
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