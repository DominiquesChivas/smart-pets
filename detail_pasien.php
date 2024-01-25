<?php

$page = "data_pasien";
include "functions/function.php";
include "template/sidebar.php";

$id = $_GET["id"];

// query data sesuai id
$pasien = query("SELECT * FROM pasien WHERE id = $id")[0];

$query = "SELECT * FROM riwayat_penyakit WHERE id_pasien = $id";

$result = mysqli_query($conn, $query);


$query2 = "SELECT * FROM riwayat_obat WHERE id_pasien = $id";

$result2 = mysqli_query($conn, $query2);


?>
            <div id="layoutSidenav_content">
                <main>
                    <!-- container -->
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Detail Pasien <?= ucwords($pasien["nama_pasien"]) ?></h1>
                        <!-- Riwayat Penyakit -->
                        <div class="card mb-4">
                            <div class="card-header">
                                Riwayat Penyakit
                            </div>
                            <div class="card-body pb-0">
                                <?php while ($data = mysqli_fetch_assoc($result)) : ?>
                                <div class="container">
                                    <h6><?= $data["tanggal"] ?></h6>
                                    <p>Penyakit : <?= ucfirst($data["penyakit"]) ?></p>
                                    <p>Catatan : <?= ucfirst($data["catatan"]) ?></p><br>
                                </div>
                                <?php endwhile ?>
                                <?php 
                                if (mysqli_num_rows($result) == 0) {
                                    echo "<p>Data tidak ditemukan</p>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                Riwayat Obat
                            </div>
                            <div class="card-body pb-0">
                                <?php while ($data = mysqli_fetch_assoc($result)) : ?>
                                <div class="container">
                                    <h6><?= $data["tanggal"] ?></h6>
                                    <p>Obat : <?= ucfirst($data["obat"]) ?></p><br>
                                </div>
                                <?php endwhile ?>
                                <?php 
                                if (mysqli_num_rows($result2) == 0) {
                                    echo "<p>Data tidak ditemukan</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                include "template/footer.php";
                ?>