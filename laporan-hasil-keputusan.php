<?php include './includes/api.php';
akses_pengguna(array(1));
include './includes/header.php';
@$periode = $_GET['periode'];
@$periode2 = $_GET['periode2'];

?>
<h5><span class="fas fa-table"></span> Laporan Hasil Keputusan</h5>
<hr>
<table class="table table-striped table-bordered table-sm">
    <tr class="text-center">
        <th>Alternatif</th>
        <th>Nilai</th>
        <th>Periode</th>
        <th>Pilih</th>
    </tr>
    <?php $no = 1;
    foreach (gethasil2($periode, $periode2) as $x) {
        echo "<tr>";
        echo "<td>{$x[1]}</td><td class=\"text-center\">{$x[3]}</td></td><td class=\"text-center\">{$x[2]}</td><td class=\"text-center\"> ";
        if ($x[4] == '0') {
            echo "<button onclick=\"location.href='./updatehasil?id={$x[0]}{$periode}'\" class=\"btn btn-success\"><span class=\"fas fa-check\"></span> Pilih</button></td>";
        } else if ($x[4] == '1') {
            echo "<a>Terpilih</a>";
        }
        echo '</tr>';
        $no++;
    } ?>
</table>
<button class="btn btn-primary" onclick="location.href='./laporan-cetak-hasil-keputusan?periode=<?php echo $periode; ?>&periode2=<?php echo $periode2; ?>'"><span class="fas fa-print"></span> Cetak Laporan Keputusan</button>
<?php include './includes/footer.php'; ?>