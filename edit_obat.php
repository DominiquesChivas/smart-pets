<?php
$page = "data_obat";
include "functions/function.php";
include "template/sidebar.php";

$id = $_GET["id"];

// query data sesuai dengan id
$obat = query("SELECT * FROM obat WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    global $conn;

    $obat = htmlspecialchars($_POST["obat"]);
    $stok = htmlspecialchars($_POST["stok"]);
    $harga = htmlspecialchars($_POST["harga"]);

    // query insert data
    $query = "UPDATE obat SET 
    nama_obat = '$obat',
    stok = '$stok',
    harga = '$harga' WHERE id = $id
    ";

    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn)) {
        alert("Data berhasil diubah");
        echo "<script>
        document.location.href = 'data_obat.php';
        </script>";
    } else {
        alert("Data gagal diubah");
        echo "<script>
        document.location.href = 'data_obat.php';
        </script>";
    }

}

?>
            <div id="layoutSidenav_content">
                <main>

                    <!-- container -->
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Ubah Data Obat</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="" method="post"> 
                                    <div class="p-2">
                                        <!-- nama obat -->
                                        <div class="pb-2">
                                            <label for="obat" class="form-label">Nama Obat</label>
                                            <input type="text" class="form-control" name="obat" aria-describedby="text" required value="<?= $obat["nama_obat"] ?>">
                                        </div>
                                        <!-- stok obat -->
                                        <div class="pb-2">
                                            <label for="stok" class="form-label">Stok Obat</label>
                                            <input type="number" class="form-control" name="stok" min="1" aria-describedby="text" required value="<?= $obat["stok"] ?>">
                                        </div>
                                        <!-- harga -->
                                        <p class="mb-2">Harga</p>
                                        <div class="input-group pb-4">
                                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                                            <input type="number" class="form-control" aria-label="harga" aria-describedby="basic-addon1" name="harga" required value="<?= $obat["harga"] ?>">
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