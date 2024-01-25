<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
$page = "data_pasien";
include "template/sidebar.php";
include "functions/function.php";

// variabel untuk ambil data
$query = "SELECT pasien.id, nama_pasien, jenis_ras, kelamin, warna, nama_pemilik FROM pasien LEFT JOIN pemilik ON pasien.id_pemilik = pemilik.id
";

// ambil data dari tabel pasien
$result = mysqli_query($conn, $query);

?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="my-4">Data Pasien</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nama Hewan</th>
                                            <th>Pemilik</th>
                                            <th>Jenis Hewan / Ras</th>
                                            <th>Warna</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Aksi</th> 
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Hewan</th>
                                            <th>Pemilik</th>
                                            <th>Jenis Hewan / Ras</th>
                                            <th>Warna</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while ($data = mysqli_fetch_assoc($result)) : ?>
                                            <tr>
                                                <td><?= ucwords($data["nama_pasien"]) ?></td>
                                                <td><?= ucwords($data["nama_pemilik"]) ?></td>
                                                <td><?= ucwords($data["jenis_ras"]) ?></td>
                                                <td><?= ucwords($data["warna"]) ?></td>
                                                <td><?= ucwords($data["kelamin"]) ?></td>
                                                <td><a href="detail_pasien.php?id=<?= $data["id"] ?>">Details</a> | <a href="edit_pasien.php?id=<?= $data["id"] ?>">Edit</a> | <a href="delete_pasien.php?id=<?= $data["id"] ?>" onclick="return confirm('Hapus data?')">Delete</a></td>
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