<?php
include './includes/api.php';
akses_pengguna(array(1));
@$id = $_GET['id'];
if (!empty($_POST)) {
    $pesan_error = array();
    $idn = $_POST['idn'];
    $idk = $_POST['id2'];
    $nilai = $_POST['nilai'];
    // var_dump($id);
    // var_dump($idk);
    // var_dump($nilai);
    // die;
    if ($nilai == '') array_push($pesan_error, 'Nilai Alternatif tidak boleh kosong');
    // $kriteria = $_POST['kriteria'];
    if (empty($pesan_error)) {
        $q = $conn->prepare("INSERT INTO nilai_alternatif VALUE ('$idn','$idk', '$nilai')");
        $q->execute();
        header('Location: ./data-nilai-alternatif');
    }
}
include './includes/header.php';
?>
<h5><span class="fas fa-plus-circle"></span> Tambah Nilai Alternatif</h1>
    <hr>
    <form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
        <input type="hidden" name="idn" value="<?= $id ?>">
        <label class="mr-sm-2" for="kriteria">Kriteria</label>
        <select id="id2" name="id2" class="form-control mb-2 mr-sm-2">
            <?php
            foreach (data_kriteria2() as $x) {
                echo "<option value=\"{$x['id_kriteria']}\">{$x['nama']}</option>";
                $idk = $x['id'];
            }
            ?>
        </select>
        <label class="mr-sm-2" for="nilai">Nilai Alternatif</label>
        <input id="nilai" name="nilai" class="form-control mb-2 mr-sm-2" type="text">
        <button class="btn btn-primary" type="submit"><span class="fas fa-plus-circle"></span> Tambah</button>
        <button class="btn btn-danger" type="reset" onclick="location.href='./data-nilai'"><span class="fas fa-times"></span> Batal</button>
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