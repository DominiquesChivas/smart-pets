<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
$page = "data_pegawai";
include "template/sidebar.php";
include "functions/function.php";

// variabel ambil data
$query = "SELECT * FROM admin";

// ambil data pasien
$result = mysqli_query($conn, $query);

?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="my-4">Data Pegawai</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jabatan</th>  
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while ($data = mysqli_fetch_assoc($result)) : ?>
                                            <tr>
                                                <td><?= ucwords($data["nama_admin"]) ?></td>
                                                <td><?= ucwords($data["jabatan"]) ?></td>
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