<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
$page = "data_diagnosa";
include "template/sidebar.php";
include "functions/function.php";

// variabel untuk ambil data
$query = "SELECT diagnosa.id, id_pasien, nama_pasien, jenis_ras, suhu, status_vaksin, tanggal, berat FROM diagnosa LEFT JOIN  pasien ON diagnosa.id_pasien = pasien.id";

$result = mysqli_query($conn, $query);  

?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="my-4">Data Diagnosa</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nama Hewan</th>
                                            <th>Jenis Hewan / Ras</th>
                                            <th>Suhu</th>
                                            <th>Status Vaksin</th>
                                            <th>Berat</th>
                                            <th>Tanggal (y-m-d)</th>
                                            <th>Aksi</th> 
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Hewan</th>
                                            <th>Jenis Hewan / Ras</th>
                                            <th>Suhu</th>
                                            <th>Status Vaksin</th>
                                            <th>Berat</th>
                                            <th>Tanggal (y-m-d)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            <?php while ($data = mysqli_fetch_assoc($result)) :?>
                                            <tr>
                                                <td><?= ucwords($data["nama_pasien"]) ?></td>
                                                <td><?= ucwords($data["jenis_ras"]) ?></td>
                                                <td><?= $data["suhu"] ?> ℃</td>
                                                <td><?= ucwords($data["status_vaksin"]) ?> Divaksin</td>
                                                <td><?= $data["berat"] ?> Kg</td>
                                                <td><?= ucwords($data["tanggal"]) ?></td>
                                                <td><a href="download_diagnosa.php?id=<?= $data["id"] ?>" target="_new">Unduh</a></td>
                                            </tr>
                                            <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                include "template/footer.php";
                ?>