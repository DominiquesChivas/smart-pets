<?php
$page = "data_pasien";
include "functions/function.php";
include "template/sidebar.php";

$id = $_GET["id"];

// query data sesuai dengan id
$pasien = query("SELECT * FROM pasien WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    global $conn;

    $nama = htmlspecialchars($_POST["pasien"]);
    $jenis = htmlspecialchars($_POST["jenis"]);
    $kelamin = htmlspecialchars($_POST["kelamin"]);
    $warna = htmlspecialchars($_POST["warna"]);

    // query insert data
    $query = "UPDATE pasien SET 
    nama_pasien = '$nama',
    jenis_ras = '$jenis',
    kelamin = '$kelamin',
    warna = '$warna' WHERE id = $id
    ";

    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn)) {
        alert("Data berhasil diubah");
        echo "<script>
        document.location.href = 'data_pasien.php';
        </script>";
    } else {
        alert("Data gagal diubah");
        echo "<script>
        document.location.href = 'data_pasien.php';
        </script>";
    }

}

?>
            <div id="layoutSidenav_content">
                <main>
                    <!-- masukkan nama pemilik -->

                    <!-- container -->
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Ubah Data Pasien</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="" method="post"> 
                                    <div class="p-2">
                                        <!-- nama pasien -->
                                        <div class="pb-2">
                                            <label for="pasien" class="form-label">Nama Hewan</label>
                                            <input type="text" class="form-control" name="pasien" aria-describedby="text" required value="<?= $pasien["nama_pasien"] ?>">
                                        </div>
                                        <!-- jenis -->
                                        <div class="pb-2">
                                            <label for="jenis" class="form-label">Jenis Hewan / Ras</label>
                                            <input type="text" class="form-control" name="jenis" aria-describedby="text" required value="<?= $pasien["jenis_ras"] ?>">
                                        </div>
                                        <!-- kelamin -->
                                        <div class="pb-2">
                                            <p>Jenis Kelamin :</p>
                                            <input type="radio" id="jantan" name="kelamin" value="jantan" <?php echo ($pasien["kelamin"] == "Jantan") ? "checked" : " " ?>>
                                            <label for="jantan">Jantan</label><br>
                                            <input type="radio" id="betina" name="kelamin" value="betina" <?php echo ($pasien["kelamin"] == "Betina") ? "checked" : " " ?>>
                                            <label for="betina">Betina</label><br>
                                        </div>
                                        <!-- warna -->
                                        <div class="pb-4">
                                            <label for="warna" class="form-label">Warna</label>
                                            <input type="text" class="form-control" name="warna" aria-describedby="text" required value="<?= $pasien["warna"] ?>">
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