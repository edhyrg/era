<?php include './includes/api.php';
akses_pengguna(array(1));
if (!empty($_GET)) {
    @$id = $_GET['id'];
    @$periode = $_GET['periode'];
    // var_dump($id);
    // var_dump($periode);
    // die;
    // $id = substr($idx, 0, -4);
    // $periode = substr($idx, -4);
    // var_dump($id);
    // var_dump($periode);
    // die;
    $q = $conn->prepare("UPDATE hasil SET pilih='1' WHERE id_hasil='$id' and periode=$periode");
    $r = $conn->prepare("UPDATE hasil SET pilih='2' WHERE id_hasil!='$id' and periode=$periode");
    // var_dump($q);
    // die;
    $q->execute();
    $r->execute();
    // header('Location: ./hasil_keputusan');
    header("Location: ./hasil_keputusan?&periode=$periode");
} else
    // header('Location: ./hasil_keputusan');
    header('Location: ./hasil_keputusan');
