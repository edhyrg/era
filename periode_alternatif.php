<?php include './includes/api.php';
include './includes/header.php';
akses_pengguna(array(1));
?>
<h5><span class="fas fa-table"></span> Pilih periode</h5>
<hr>

<div class="col-md-6">
    <select required class="form-control required" id="periode" name="periode">
        <?php foreach (periode() as $x) {
            echo "<option$s value=\"{$x['periode']}\">{$x['periode']}</option>";
        }
        ?>
    </select>
    <button class="btn btn-primary" id="pilih"><span class="fas fa-radiation"></span> Pilih</button>
</div>
<script>
    $(document).ready(function() {
        $('#pilih').on('click', function() {
            var periode = $('#periode option:selected').val();
            var url = './data-nilai-alternatif?';
            url += '&periode=' + periode;
            window.location = url;
            return (false);
        });
    });
</script>