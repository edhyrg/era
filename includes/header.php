<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyek SPK</title>
    <script src="./js/jquery.min.js"></script>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">
    <script src="./js/bootstrap.min.js"></script>
    <link href="./css/fontawesome-free-5.11.2-web/css/all.min.css" rel="stylesheet">
    <script src="./css/fontawesome-free-5.11.2-web/js/all.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color: #6f0000;">
        <div class="container">
            <a class="navbar-brand" href="./">CHANIPIL COLLECTION</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item" id="beranda">
                        <a class="nav-link" href="./"><span class="fas fa-home"></span> Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-bars"></span> Master
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="./data-kriteria" id="data-kriteria"><span class="fas fa-table"></span> Entri Data Kriteria</a>
                            <a class="dropdown-item" href="./data-alternatif" id="data-alternatif"><span class="fas fa-users"></span> Entri Data Alternatif</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-bars"></span> Proses
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="./perbandingan-kriteria" id="perbandingan-kriteria"><span class="fas fa-sliders-h"></span> Entri Bobot Kriteria</a>
                            <!-- <a class="dropdown-item" href="./data-nilai" id="data-nilai"><span class="fas fa-table"></span>Tambah Nilai Alternatif</a>
                            <a class="dropdown-item" href="./upload-data-alternatif" id="upload-data-alternatif"><span class="fas fa-upload"></span> Upload Data Alternatif</a> -->
                            <a class="dropdown-item" href="./periode_alternatif" id="periode_alternatif"><span class="fas fa-table"></span> Entri Nilai Alternatif</a>
                            <a class="dropdown-item" href="./periode_hasil" id="periode_hasil"><span class="fas fa-table"></span> Cetak Hasil Keputusan</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-bars"></span> Laporan
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="./periode_keputusan" id="periode_keputusan"><span class="fas fa-users"></span> Cetak Laporan Hasil Pemilihan Supplier</a>
                            <a class="dropdown-item" href="./periode_rangking" id="periode_rangking"><span class="fas fa-table"></span> Cetak Laporan Hasil Perangkingan Supplier</a>
                            <a class="dropdown-item" href="./periode_evaluasi" id="periode_evaluasi"><span class="fas fa-users"></span> Cetak Laporan Penilaian Supplier</a>
                        </div>
                    </li>
                    <li class="nav-item" id="manajemen-pengguna">
                        <a class="nav-link" href="./manajemen-pengguna"><span class="fas fa-users-cog"></span> Manajemen Pengguna<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav"> <?php if (empty(pengguna())) { ?>
                        <li class="nav-item" id="masuk">
                            <a class="nav-link" href="./masuk"><span class="fas fa-sign-in-alt"></span> Masuk<span class="sr-only">(current)</span></a>
                        </li>
                    <?php } else { ?> <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fas fa-user"></span> <?= pengguna()['nama'] ?> (<?= pengguna()['keterangan'] ?>)
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="./keluar" id="keluar"><span class="fas fa-sign-out-alt"></span> Keluar</a>
                            </div>
                        </li> <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="margin-top:80px;margin-bottom:80px;">
        <!-- MULAI BODY -->