<?php include './includes/api.php';
include './includes/header.php';
akses_pengguna(array(1));
@$periode = $_GET['periode'];
// var_dump($periode);
// die;
echo '<h5><span class="fas fa-table"></span> Laporan Hasil Perankingan</h5><hr>';
if (count(data_alternatif()) > 0 && count(hasilall($periode)) > 0) {

?>

    <table class="table table-bordered table-sm table-striped small">
        <tr class="text-center">
            <th>Ranking</th>
            <th>Alternatif</th>
            <th>Nilai</th>
        </tr>
        <?php $no = 1;

        foreach (hasilall($periode) as $y) {
            echo "<td>$no</td>";
            $nama = $y['nama'];
            $hasil = $y['hasil'];
            echo "<td>$nama</td>";
            echo "<td>$hasil</td>";
            echo '</tr>';
            $no++;
        }
        // echo "<td class=\"text-center\"><button onclick=\"location.href='./tambah-nilai?id={$x[0]}'\" class=\"btn btn-primary\"><span class=\"fas fa-plus\"></span> Tambah</button> <button onclick=\"hapus_nilai('{$x[0]}')\" class=\"btn btn-danger\"><span class=\"fas fa-trash-alt\"></span> Hapus</button></td>";

        ?>
    </table>
    <button class="btn btn-primary" onclick="location.href='./laporan-cetak-hasil-rangking?periode=<?php echo $periode; ?>'"><span class="fas fa-radiation"></span> Cetak Laporan</button>
<?php
} else {
    if (count(data_kriteria()) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data kriteria kosong</b>, silahkan hubungi Petugas.</div>';
    if (count(data_alternatif()) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data alternatif kosong</b>, silahkan hubungi Petugas.</div>';
    if (!cek_valid_bobot()) echo '<div class="alert alert-dismissable alert-danger"><b>Perbadingan bobot kriteria tidak valid</b>, silahkan hubungi Pakar/Ahli.</div>';
}
include './includes/footer.php'; ?>