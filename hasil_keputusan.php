<?php include './includes/api.php';
akses_pengguna(array(1));
include './includes/header.php';
@$periode = $_GET['periode'];
?>
<h5><span class="fas fa-table"></span> Data Hasil Keputusan</h5>
<hr>
<table class="table table-striped table-bordered table-sm">
    <tr class="text-center">
        <th>Rangking</th>
        <th>Alternatif</th>
        <th>Nilai</th>
        <th>Pilih</th>
    </tr>
    <?php $no = 1;
    foreach (gethasil($periode) as $x) {
        echo "<tr>";
        echo "<td class=\"text-center\">$no</td><td>{$x[1]}</td><td class=\"text-center\">{$x[2]}</td><td class=\"text-center\"> ";
        if ($x[3] == '0') {
            echo "<button onclick=\"location.href='./updatehasil?id={$x[0]}&periode={$periode}'\" class=\"btn btn-success\"><span class=\"fas fa-check\"></span> Pilih</button></td>";
        } else if ($x[3] == '1') {
            echo "<a>Terpilih</a>";
        }
        echo '</tr>';
        $no++;
    } ?>
</table>
<button class="btn btn-primary" onclick="location.href='./laporan-surat-keputusan?periode=<?php echo $periode; ?>'"><span class="fas fa-print"></span> Cetak Surat Keputusan</button>
<?php include './includes/footer.php'; ?>