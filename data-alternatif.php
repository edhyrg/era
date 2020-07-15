<?php include './includes/api.php';
akses_pengguna(array(1));
include './includes/header.php';
?>
<h5><span class="fas fa-table"></span> Data Alternatif</h5>
<hr>
<table class="table table-striped table-bordered table-sm">
    <tr class="text-center">
        <th>No</th>
        <th>Nama Alternatif</th>
        <th>Alamat</th>
        <th>No. Telp</th>
        <th>Periode</th>
        <th>Aksi</th>
    </tr>
    <?php $no = 1;
    foreach (data_alternatif() as $x) {
        echo "<tr>";
        echo "<td class=\"text-center\">$no</td><td>{$x[1]}</td><td class=\"text-center\">{$x[2]}</td><td class=\"text-center\">{$x[3]}</td><td class=\"text-center\">{$x[4]}</td><td class=\"text-center\"><button onclick=\"location.href='./edit-alternatif?id={$x[0]}'\" class=\"btn btn-primary\"><span class=\"fas fa-pen\"></span> Edit</button> <button onclick=\"hapus_alternatif('{$x[0]}')\" class=\"btn btn-danger\"><span class=\"fas fa-trash-alt\"></span> Hapus</button></td>";
        echo '</tr>';
        $no++;
    } ?>
</table>
<button class="btn btn-primary" onclick="location.href='./tambah-alternatif'"><span class="fas fa-plus-circle"></span> Tambah Alternatif</button>
<?php include './includes/footer.php'; ?>