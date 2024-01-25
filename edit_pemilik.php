<?php

$page = "data_pemilik";
include "functions/function.php";
include "template/sidebar.php";

$id = $_GET["id"];

// query data sesuai id
$pemilik = query("SELECT * FROM pemilik WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    global $conn;

    $pemilik = htmlspecialchars($_POST["pemilik"]);
    $no_telp = htmlspecialchars($_POST["no_telp"]);
    $alamat = htmlspecialchars($_POST["alamat"]);

    // query insert data
    $query = "UPDATE pemilik SET 
    nama_pemilik = '$pemilik',
    no_telp = '$no_telp',
    alamat = '$alamat' WHERE id = $id
    ";

    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn)) {
        alert("Data berhasil diubah");
        echo "<script>
        document.location.href = 'data_pemilik.php';
        </script>";
    } else {
        alert("Data gagal diubah");
        echo "<script>
        document.location.href = 'data_pemilik.php';
        </script>";
    }
}

?>
            <div id="layoutSidenav_content">
                <main>
                    <!-- masukkan nama pemilik -->

                    <!-- container -->
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Ubah Data Pemilik</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="" method="post"> 
                                    <div class="p-2">
                                        <!-- nama pemilik -->
                                        <div class="pb-2">
                                            <label for="pemilik" class="form-label">Nama Pemilik</label>
                                            <input type="text" class="form-control" name="pemilik" aria-describedby="text" required value="<?= $pemilik["nama_pemilik"] ?>">
                                        </div>
                                        <!-- nomor telp -->
                                        <div class="pb-2">
                                            <label for="no_telp" class="form-label">Nomor Telepon / HP</label>
                                            <input type="text" class="form-control" name="no_telp" aria-describedby="text" required value="<?= $pemilik["no_telp"] ?>">
                                        </div>
                                        <!-- alamat -->
                                        <div class="pb-4">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" name="alamat" aria-describedby="text" required value="<?= $pemilik["alamat"] ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                include "template/footer.php";
                ?>