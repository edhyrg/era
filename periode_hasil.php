<?php include './includes/api.php';
include './includes/header.php';
akses_pengguna(array(1));
?>
<h5><span class="fas fa-table"></span> Pilih periode</h5>
<hr>

<div class="col-md-6">
    <div class="form-group"><label>PERIODE</label><br>
        <select required class="form-control required" id="periode" name="periode">
            <?php foreach (periode() as $x) {
                echo "<option$s value=\"{$x['periode']}\">{$x['periode']}</option>";
            }
            ?>
        </select>
    </div>
    <button class="btn btn-primary" id="pilih"><span class="fas fa-radiation"></span> Pilih</button>
</div>
<script>
    $(document).ready(function() {
        $('#pilih').on('click', function() {
            var periode = $('#periode option:selected').val();
            var url = './hasil_keputusan?';
            url += '&periode=' + periode;
            window.location = url;
            return (false);
        });
    });
</script>