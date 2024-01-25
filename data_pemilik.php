<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
$page = "data_pemilik";
include "template/sidebar.php";
include "functions/function.php";

// variabel untuk ambil data
$query = "SELECT * FROM pemilik";

// ambil data dari tabel pemilik
$result = mysqli_query($conn, $query);

?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="my-4">Data Pemilik</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nama Pemilik</th>
                                            <th>No. telp / HP</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th> 
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Pemilik</th>
                                            <th>No. telp / HP</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while ($data = mysqli_fetch_assoc($result)) : ?>
                                        <tr>
                                            <td><?= ucwords($data["nama_pemilik"]) ?></td>
                                            <td><?= $data["no_telp"] ?></td>
                                            <td><?= ucfirst($data["alamat"]) ?></td>
                                            <td><a href="edit_pemilik.php?id=<?= $data["id"] ?>">Edit</a> | <a href="delete_pemilik.php?id=<?= $data["id"] ?>" onclick="return confirm('Hapus data?')">Delete</a></td>
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