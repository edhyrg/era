<?php include './includes/api.php';
akses_pengguna(array(1));
if (!empty($_GET)) {
    @$idx = $_GET['id'];
    $id = substr($idx, 0, -4);
    $periode = substr($idx, -4);
    // var_dump($id);
    // var_dump($periode);
    // die;
    $q = $conn->prepare("UPDATE hasil SET pilih='1' WHERE id_hasil='$id'");
    $r = $conn->prepare("UPDATE hasil SET pilih='2' WHERE id_hasil!='$id'");
    $q->execute();
    $r->execute();
    // header('Location: ./hasil_keputusan');
    header("Location: ./hasil_keputusan?&periode=$periode");
} else
    // header('Location: ./hasil_keputusan');
    header('Location: ./hasil_keputusan');
