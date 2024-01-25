<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
$page = "daftar_obat";
include "template/sidebar.php";
include "functions/function.php";

// cek apakah tombol submit sudah ditekkan
if (isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan
    if (tambahObat($_POST) > 0) {
        echo "<script>
        alert('Data Obat berhasil dimasukkan');
        document.location.href = 'data_obat.php';
        </script>";
    } else {
        echo mysqli_error($conn);
    }

}

?>
            <div id="layoutSidenav_content">
                <main>

                    <!-- container -->
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Daftar Obat</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="" method="post"> 
                                    <div class="p-2">
                                        <!-- nama obat -->
                                        <div class="pb-2">
                                            <label for="obat" class="form-label">Nama Obat</label>
                                            <input type="text" class="form-control" name="obat" aria-describedby="text" required>
                                        </div>
                                        <!-- stok obat -->
                                        <div class="pb-2">
                                            <label for="stok" class="form-label">Stok Obat</label>
                                            <input type="number" class="form-control" name="stok" min="1" aria-describedby="text" required>
                                        </div>
                                        <!-- harga -->
                                        <p class="mb-2">Harga</p>
                                        <div class="input-group pb-4">
                                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                                            <input type="number" class="form-control" aria-label="harga" aria-describedby="basic-addon1" name="harga">
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