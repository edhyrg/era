<?php
include './includes/api.php';
akses_pengguna(array(1));
@$idx = $_GET['id'];
@$idx = $_GET['id'];
$id = substr($idx, 0, -4);
$periode = substr($idx, -4);
if (!empty($_POST)) {
    foreach (data_kriteria2() as $y) {
        $pesan_error = array();
        $idn = $_POST['idn'];
        $idk = $y['id_kriteria'];
        $nilai = $_POST[$idk];
        // var_dump($idn);
        // var_dump($idk);
        // var_dump($nilai);
        // die;
        if ($nilai == '') array_push($pesan_error, 'Nilai Alternatif tidak boleh kosong');
        // $kriteria = $_POST['kriteria'];
        if (empty($pesan_error)) {
            $q = $conn->prepare("INSERT INTO nilai_alternatif VALUE ('$idn','$idk', '$nilai', '$periode')");
            $q->execute();
        }
    }
    // $idk = $_POST['id2'];
    // var_dump($id);
    // var_dump($idk);
    // var_dump($nilai);
    // die;
    header("Location: ./data-nilai-alternatif?periode=$periode");
}
include './includes/header.php';
?>
<h5><span class="fas fa-plus-circle"></span> Tambah Nilai Alternatif</h1>
    <hr>
    <form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
        <input type="hidden" name="idn" value="<?= $id ?>">
        <?php foreach (data_kriteria2() as $x) { ?>
            <label class="mr-sm-2" for="kriteria"><?= $x['nama'] ?></label>
            <input id=<?= $x['id_kriteria'] ?> name=<?= $x['id_kriteria'] ?> class="form-control mb-2 mr-sm-2" type="text">
        <?php } ?>
        <button class="btn btn-primary" type="submit"><span class="fas fa-plus-circle"></span> Tambah</button>
        <button class="btn btn-danger" type="reset" onclick="location.href='./data-nilai-alternatif?periode=<?php echo $periode ?>'"><span class="fas fa-times"></span> Batal</button>
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