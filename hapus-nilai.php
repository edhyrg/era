<?php include './includes/api.php';
akses_pengguna(array(1));
if (!empty($_GET)) {
    @$id = $_GET['id'];
    $q = $conn->prepare("DELETE FROM nilai_alternatif WHERE alternatif='$id'");
    $q->execute();
    header('Location: ./data-nilai-alternatif');
} else header('Location: ./data-nilai-alternatif');
