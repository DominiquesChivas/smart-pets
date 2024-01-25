<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
$page = "data_obat";
include "template/sidebar.php";
include "functions/function.php";

// variabel untuk ambil data
$query = "SELECT * FROM obat";

// ambil data dari tabel obat
$result = mysqli_query($conn, $query);

?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="my-4">Data Obat</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nama Obat</th>
                                            <th>Stok</th>
                                            <th>Harga</th> 
                                            <th>Aksi</th> 
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Obat</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php while ($data = mysqli_fetch_assoc($result)) : ?>
                                        <tr>
                                            <td><?= ucwords($data["nama_obat"]) ?></td>
                                            <td><?= $data["stok"] ?></td>
                                            <td>Rp. <?= $data["harga"] ?></td>
                                            <td><a href="edit_obat.php?id=<?= $data["id"] ?>">Edit</a> | <a href="delete_obat.php?id=<?= $data["id"] ?>" onclick="return confirm('Hapus data?')">Delete</a></td>
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