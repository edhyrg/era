<?php
$NAMA_DATABASE = 'era';
$USERNAME_DATABASE = 'root';
$PASSWORD_DATABASE = '';
$conn = new PDO("mysql:host=localhost;dbname=$NAMA_DATABASE", $USERNAME_DATABASE, $PASSWORD_DATABASE);
if (isset($_COOKIE['tanggapan'])) $TANGGAPAN = $_COOKIE['tanggapan'];
else {
    $q = $conn->prepare('SELECT UUID()');
    $q->execute();
    $uuid = @$q->fetchAll()[0][0];
    $TANGGAPAN = $uuid;
    setcookie('tanggapan', $uuid, time() + 3600 * 24 * 30 * 12);
}

function tanggapan()
{
    global $TANGGAPAN, $conn;
    @$action = $_POST['action'];
    if ($action == 'push') {
        $q = $conn->prepare("DELETE FROM tanggapan WHERE id_tanggapan='$TANGGAPAN'");
        $q->execute();
        $q = $conn->prepare("INSERT INTO tanggapan VALUE ('$TANGGAPAN', '{$_POST['tanggapan']}', '{$_POST['akurasi']}')");
        $q->execute();
    } else {
        $q = $conn->prepare("SELECT akurasi FROM tanggapan");
        $q->execute();
        if ($q->rowCount() > 0) {
            $data = $q->fetchAll();
            $j = 0;
            foreach ($data as $x) $j += $x['akurasi'];
            return strval($j / count($data)) . ' % (' . strval(count($data)) . ' tanggapan)';
        } else return strval(100) . ' % (0 tanggapan)';
    }
}

function akses_pengguna($level = false)
{
    if (!empty(pengguna())) {
        if ($level != false) {
            $akses = false;
            foreach ($level as $x)
                if ($x == pengguna()['level'])
                    $akses = true;
            if (!$akses) {
                exit('<div style="font-size: 20pt;position: absolute;transform: translate(-50%, -50%);  top: 50%;left: 50%;margin: auto;text-align: center;"><span style="font-family: Lucida Console;">Akses tidak diijinkan</span><br><br><span style="font-family: Lucida Console;cursor: pointer;color: blue;" onclick="location.href=\'./\'"><< <u>Kembali ke halaman awal</u> <<</a></span></div>');
            }
        }
    } else {
        exit('<div style="font-size: 20pt;position: absolute;transform: translate(-50%, -50%);  top: 50%;left: 50%;margin: auto;text-align: center;"><span style="font-family: Lucida Console;">Akses tidak diijinkan</span><br><br><span style="font-family: Lucida Console;cursor: pointer;color: blue;" onclick="location.href=\'./\'"><< <u>Kembali ke halaman awal</u> <<</a></span></div>');
    }
}

function cek_valid_bobot()
{
    global $conn;
    $q = $conn->prepare("SELECT * FROM kriteria WHERE bobot IS NULL");
    $q->execute();
    if ($q->rowCount() > 0) return false;
    return true;
}

function pengguna($pengguna = false)
{
    global $conn;
    @$id = $_COOKIE['masuk'];
    if ($pengguna != false) $q = $conn->prepare("SELECT * FROM pengguna p JOIN level l on p.level=l.id_level WHERE p.username='$pengguna'");
    else $q = $conn->prepare("SELECT * FROM masuk m JOIN pengguna p ON m.pengguna=p.username JOIN level l on p.level=l.id_level WHERE m.id_pengguna='$id'");
    $q->execute();
    return @$q->fetchAll()[0];
}

function data_kriteria()
{
    global $conn;
    $q = $conn->prepare('SELECT * FROM kriteria JOIN atribut ON kriteria.atribut=atribut.id_atribut');
    $q->execute();
    return @$q->fetchAll();
}
function data_kriteria2()
{
    global $conn;
    $q = $conn->prepare('SELECT * FROM kriteria');
    $q->execute();
    return @$q->fetchAll();
}
function data_alternatif()
{
    global $conn;
    $q = $conn->prepare('SELECT * FROM alternatif');
    $q->execute();
    return @$q->fetchAll();
}
function data_alternatif2($periode, $periode2)
{
    global $conn;
    $q = $conn->prepare("SELECT a.*, b.periode FROM alternatif a join nilai_alternatif b WHERE b.periode between $periode and $periode2 group by id_alternatif");
    $q->execute();
    return @$q->fetchAll();
}
function data_alternatif3($periode)
{
    global $conn;
    $q = $conn->prepare("SELECT a.*, b.periode FROM alternatif a join nilai_alternatif b on a.id_alternatif=b.alternatif WHERE b.periode=$periode group by a.id_alternatif");
    $q->execute();
    return @$q->fetchAll();
}
function hasil($periode, $periode2)
{
    global $conn;
    $q = $conn->prepare("SELECT h.hasil,h.periode, a.* FROM hasil h LEFT JOIN alternatif a ON a.id_alternatif=h.id_alternatif where h.pilih=1 and h.periode between $periode and $periode2");
    $q->execute();
    return @$q->fetchAll();
}
function hasil2($periode)
{
    global $conn;
    $q = $conn->prepare("SELECT h.hasil,h.periode, a.* FROM hasil h LEFT JOIN alternatif a ON a.id_alternatif=h.id_alternatif where h.pilih=1 and h.periode=$periode");
    $q->execute();
    return @$q->fetchAll();
}
function hasilall($periode, $periode2)
{
    global $conn;
    $q = $conn->prepare("SELECT h.hasil, h.periode, a.* FROM hasil h LEFT JOIN alternatif a ON a.id_alternatif=h.id_alternatif where h.periode between $periode and $periode2");
    $q->execute();
    return @$q->fetchAll();
}

function data_pengguna()
{
    global $conn;
    $q = $conn->prepare("SELECT * FROM pengguna p JOIN level l on p.level=l.id_level");
    $q->execute();
    return @$q->fetchAll();
}

function data_atribut()
{
    global $conn;
    $q = $conn->prepare('SELECT * FROM atribut');
    $q->execute();
    return @$q->fetchAll();
}

function data_level()
{
    global $conn;
    $q = $conn->prepare('SELECT * FROM level');
    $q->execute();
    return @$q->fetchAll();
}

function bobot_kriteria($k1, $k2)
{
    if ($k1 == $k2) return array('bobot' => '1/1', 'nilai' => 1);
    global $conn;
    $q = $conn->prepare("SELECT * FROM bobot_kriteria WHERE (kriteria_1='$k1' AND kriteria_2='$k2') OR (kriteria_1='$k2' AND kriteria_2='$k1')");
    $q->execute();
    @$data = $q->fetchAll()[0];
    if ($data) {
        @$bobot1 = explode('/', $data['bobot'])[0];
        @$bobot2 = explode('/', $data['bobot'])[1];
        @$n1 = $bobot1 / $bobot2;
        @$n2 = $bobot2 / $bobot1;
        if ($k1 == $data['kriteria_1']) return array('bobot' => $data['bobot'], 'nilai' => $n1);
        else return array('bobot' => $bobot2 . '/' . $bobot1, 'nilai' => $n2);
        return $data;
    } else return false;
}

function nilai_alternatif($a, $k, $periode)
{
    global $conn;
    $q = $conn->prepare("SELECT * FROM nilai_alternatif WHERE alternatif='$a' AND kriteria='$k' and periode='$periode'");
    $q->execute();
    @$data = $q->fetchAll()[0][2];
    if ($data) return $data;
    else return 0;
}
function nilai_alternatif2($a, $k, $periode1, $periode2)
{
    global $conn;
    $q = $conn->prepare("SELECT * FROM nilai_alternatif WHERE alternatif='$a' AND kriteria='$k' and periode between '$periode1' and '$periode2' ");
    $q->execute();
    @$data = $q->fetchAll()[0][2];
    if ($data) return $data;
    else return 0;
}

function data_nilai_alternatif()
{
    global $conn;
    $q = $conn->prepare("SELECT * FROM alternatif");
    $q->execute();
    @$data = $q->fetchAll();
    if ($data) return $data;
    else return array();
}
function periode()
{
    global $conn;
    $q = $conn->prepare("SELECT periode FROM nilai_alternatif group by periode");
    $q->execute();
    @$data = $q->fetchAll();
    if ($data) return $data;
    else return array();
}
function getPeriode()
{
    global $conn;
    $q = $conn->prepare("SELECT periode FROM alternatif group by periode");
    $q->execute();
    @$data = $q->fetchAll();
    if ($data) return $data;
    else return array();
}
function gethasil($periode)
{
    global $conn;
    $q = $conn->prepare("SELECT h.id_hasil, a.nama, h.hasil, h.pilih FROM hasil h left join alternatif a on h.id_alternatif=a.id_alternatif where h.periode='$periode' ");
    $q->execute();
    @$data = $q->fetchAll();
    if ($data) return $data;
    else return array();
}
function gethasil2($periode, $periode2)
{
    global $conn;
    $q = $conn->prepare("SELECT h.id_hasil, a.nama, h. periode, h.hasil, h.pilih FROM hasil h left join alternatif a on h.id_alternatif=a.id_alternatif where h.pilih=1 and h.periode between '$periode' and '$periode2'");
    $q->execute();
    @$data = $q->fetchAll();
    if ($data) return $data;
    else return array();
}
