<?php include './includes/api.php';
include './includes/header.php';
akses_pengguna(array(1));
@$periode = $_GET['periode'];

$q = $conn->prepare("DELETE FROM hasil WHERE periode='$periode'");
$q->execute();
?>
<h5><span class="fas fa-radiation"></span> Proses Data</h5>
<hr>
<h6>Data</h6>
<table class="table table-bordered table-sm table-striped small">
    <tr class="text-center">
        <th>Alternatif</th>
        <?php
        foreach (data_kriteria() as $x) echo "<th>{$x[1]} ({$x[5]})</th>";
        ?>
    </tr>
    <?php
    $data = array();
    foreach (data_alternatif3($periode) as $x) {
        echo "<tr><td>{$x[1]}</td>";
        foreach (data_kriteria() as $y) {
            $n = nilai_alternatif($x[0], $y[0], $periode);
            echo "<td>$n</td>";
            $data[$y[0]][$x[0]] = $n;
        }
        echo '</tr>';
    }
    ?>
</table>
<hr>
<h6>Normalisasi</h6>
<table class="table table-bordered table-sm table-striped small">
    <tr class="text-center">
        <th>Alternatif</th>
        <?php
        foreach (data_kriteria() as $x) echo "<th>{$x[1]} ({$x[3]})</th>";
        ?>
    </tr>
    <?php
    $data_normalisasi = array();
    $data_hasil = array();
    foreach (data_alternatif3($periode) as $x) {
        echo "<tr><td>{$x[1]}</td>";
        foreach (data_kriteria() as $y) {
            if ($y[2] == 1) $n = round(nilai_alternatif($x[0], $y[0], $periode) / max($data[$y[0]]), 4);
            else $n = round(min($data[$y[0]]) / nilai_alternatif($x[0], $y[0], $periode), 4);
            echo "<td>$n</td>";
            $data_normalisasi[$y[0]][$x[0]] = $n;
            $data_hasil[$x[0]][$y[0]] = $n * $y[3];
        }
        echo '</tr>';
    }
    ?>
</table>
<hr>
<?php
$hasil = array();
foreach (array_keys($data_hasil) as $x) {
    $hasil[$x] = round(array_sum($data_hasil[$x]), 4);
}
arsort($hasil);
?>
<h6>Hasil</h6>
<div id="tempat-hasil">
    <?php
    $q = $conn->prepare("SELECT tanggapan FROM tanggapan WHERE id='$TANGGAPAN'");
    $q->execute();
    $akurasi_di_sini = 100;
    if ($q->rowCount() > 0) {
        echo $q->fetchAll()[0]['tanggapan'];
        $q = $conn->prepare("SELECT akurasi FROM tanggapan WHERE id='$TANGGAPAN'");
        $q->execute();
        $akurasi_di_sini = $q->fetchAll()[0]['akurasi'];
        echo '<script>__nilai = ' . $akurasi_di_sini . ';</script>';
    } else {
        echo '<script>__nilai = 100;</script>';
    ?>
        <!-- <form role="form" method="post" action="<?php echo ('Updatehasil'); ?>"> -->
        <table class="table table-bordered table-sm table-striped small">
            <tr class="text-center">
                <th>Rangking</th>
                <th>Alternatif</th>
                <th>Nilai</th>
            </tr>
            <?php
            $no = 1;
            foreach (array_keys($hasil) as $x) {
                $q = $conn->prepare("SELECT * FROM alternatif WHERE id_alternatif='$x'");
                $q->execute();
                @$data = $q->fetchAll()[0];
                @$nama = $data[1];
                @$id =  $data[0];
                echo "<tr id=\"baris-$id\"><td>$no</td><td>$nama</td><td>{$hasil[$x]}</td></tr>";
                $simpan = $conn->prepare("INSERT INTO hasil VALUE ('', '$id','$hasil[$x]','$periode','')");
                $simpan->execute();

                $no++;
            }
            ?>
        </table>
        <div class="">

            <!-- <button type="submit" class="btn btn-primary" name="button" value="simpan">SIMPAN HASIL</button> -->

        </div>
        <!-- </form> -->
    <?php } ?>
</div>
<!-- <h6>Akurasi tanggapan anda: <span id="akurasi-di-sini"><?= $akurasi_di_sini ?> %</span></h6>
<hr>
<h6>Total akurasi keseluruhan: <span id="akurasi"><span class="bg-warning">menunggu jaringan . .</span></span></h6>
<hr> -->
<script>
    var pilih = <?= @count($hasil) ?>;

    // function fetch() {

    //     var id = $('#id'.val());
    //     console.log(id);
    //     $.ajax({
    //         type: 'POST',
    //         url: 'updatehasil',
    //         data: {
    //             'id': 'id'
    //         },
    //         success: function(pesan) {
    //             $('#akurasi').html(pesan);
    //         },
    //         error: function(pesan) {
    //             $('#akurasi').html('<span class="bg-danger text-white">Tidak dapat terhubung ke jaringan</span>');
    //         }
    //     });
    // }
    // setTimeout(() => {
    //     setInterval(function() {
    //         fetch();
    //     }, 1000);
    // }, 1000);

    // $('.sesuai').click(function(e) {
    //     // if (e.target.checked) {
    //     //     e.target.setAttribute("checked", "");
    //     //     $('#baris-' + e.target.id.split('-')[1]).removeClass('bg-danger');
    //     //     $('#label-' + e.target.id.split('-')[1]).html('Sesuai');
    //     //     window.__nilai += (1 / window.__total * 100);
    //     // } else {
    //     //     e.target.removeAttribute("checked");
    //     //     $('#baris-' + e.target.id.split('-')[1]).addClass('bg-danger');
    //     //     $('#label-' + e.target.id.split('-')[1]).html('Tidak sesuai');
    //     //     window.__nilai -= (1 / window.__total * 100);
    //     // }
    //     // $('#akurasi-di-sini').html(window.__nilai + ' %');
    //     $.ajax({
    //         type: 'POST',
    //         url: 'tanggapan',
    //         data: {
    //             'action': 'push',
    //             'pilih': window.pilih,
    //             'tanggapan': $('#tempat-hasil').html()
    //         },
    //         success: function(pesan) {
    //             //console.log(pesan);
    //         }
    //     });
    // });

    // function setChecks(obj) {
    //     //increment/decrement checkCount
    //     // if (obj.checked) {
    //     //     checkCount = checkCount + 1
    //     // } else {
    //     //     checkCount = checkCount - 1
    //     // }
    //     // //if they checked a 4th box, uncheck the box, then decrement checkcount and pop alert
    //     // if (checkCount > maxChecks) {
    //     //     obj.checked = false
    //     //     checkCount = checkCount - 1
    //     //     alert('you may only choose up to ' + maxChecks + ' options')
    //     // }
    // }
</script>
<?php include './includes/footer.php'; ?>