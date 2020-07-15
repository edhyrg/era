<?php include './includes/api.php';
akses_pengguna(array(1));
if (!empty($_GET)) {
    @$idx = $_GET['id'];
    @$idx = $_GET['id'];
    $id = substr($idx, 0, -4);
    $periode = substr($idx, -4);
    // var_dump($periode);
    // die;
    $q = $conn->prepare("DELETE FROM nilai_alternatif WHERE alternatif='$id'");
    $q->execute();
    header("Location: ./data-nilai-alternatif?periode=$periode");
} else header("Location: ./data-nilai-alternatif?periode=$periode");
