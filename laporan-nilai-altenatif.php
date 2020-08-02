<?php include './includes/api.php';
include './includes/header.php';
akses_pengguna(array(1));
@$periode = $_GET['periode'];
@$periode2 = $_GET['periode2'];
echo '<h5><span class="fas fa-table"></span> Laporan Nilai Alternatif</h5><hr>';
if (count(data_alternatif2($periode, $periode2)) > 0 & count(data_kriteria()) > 0 & cek_valid_bobot()) {
?>
    <table class="table table-bordered table-sm table-striped small">
        <tr class="text-center">
            <th>No</th>
            <th>Alternatif</th>
            <th>Periode</th>
            <?php
            foreach (data_kriteria() as $x) echo "<th>{$x[1]}</th>";
            ?>

        </tr>
        <?php $no = 1;
        foreach (data_alternatif2($periode, $periode2) as $x) {
            echo "<tr><td class=\"text-center\">$no</td><td>{$x[1]}</td><td>{$x[4]}</td>";
            foreach (data_kriteria() as $y) {
                $n = nilai_alternatif($x[0], $y[0], $periode);
                echo "<td>$n</td>";
            }
            // echo "<td class=\"text-center\"><button onclick=\"location.href='./tambah-nilai?id={$x[0]}'\" class=\"btn btn-primary\"><span class=\"fas fa-plus\"></span> Tambah</button> <button onclick=\"hapus_nilai('{$x[0]}')\" class=\"btn btn-danger\"><span class=\"fas fa-trash-alt\"></span> Hapus</button></td>";
            echo '</tr>';
            $no++;
        }
        ?>
    </table>
    <button class="btn btn-primary" onclick="location.href='./laporan-cetak-nilai-alternatif?periode=<?php echo $periode; ?>&periode2=<?php echo $periode2; ?>'"><span class="fas fa-radiation"></span> Cetak Laporan</button>
<?php
} else {
    if (count(data_kriteria()) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data kriteria kosong</b>, silahkan hubungi Petugas.</div>';
    if (count(data_alternatif()) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data alternatif kosong</b>, silahkan hubungi Petugas.</div>';
    if (!cek_valid_bobot()) echo '<div class="alert alert-dismissable alert-danger"><b>Perbadingan bobot kriteria tidak valid</b>, silahkan hubungi Pakar/Ahli.</div>';
}
include './includes/footer.php'; ?>