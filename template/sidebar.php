<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Smart Pets</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <!-- navbar -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Smart Pets</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <a class="btn btn-link" style="margin-left: 1000px;" onclick="return confirm('Logout?')" href="logout.php">Logout</a>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link <?php if ($page == "index") {echo "active";}?>" href="index.php">
                                <img class="sb-nav-link-icon" src="assets/img/pen-icon.svg" alt="pen">
                                Diagnosa
                            </a>
                            <a class="nav-link <?php if ($page == "cek_data") {echo "active";}?>" href="cek_data.php">
                                <img class="sb-nav-link-icon" src="assets/img/pen-icon.svg" alt="pen">
                                Daftar Pasien
                            </a>
                            <a class="nav-link <?php if ($page == "daftar_obat") {echo "active";}?>" href="daftar_obat.php">
                                <img class="sb-nav-link-icon" src="assets/img/pen-icon.svg" alt="pen">
                                Daftar Obat
                            </a>
                            <div class="sb-sidenav-menu-heading">Data</div>
                            <a class="nav-link <?php if ($page == "data_pasien") {echo "active";}?>" href="data_pasien.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Pasien
                            </a>
                            <a class="nav-link <?php if ($page == "data_pemilik") {echo "active";}?>" href="data_pemilik.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Pemilik
                            </a>
                            <a class="nav-link <?php if ($page == "data_diagnosa") {echo "active";}?>" href="data_diagnosa.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Diagnosa
                            </a>
                            <a class="nav-link <?php if ($page == "data_pegawai") {echo "active";}?>" href="data_pegawai.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Pegawai
                            </a>
                            <a class="nav-link <?php if ($page == "data_obat") {echo "active";}?>" href="data_obat.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Data Obat
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Masuk sebagai :</div>
                        Dokter
                    </div>
                </nav>
            </div>