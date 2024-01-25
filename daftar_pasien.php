<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
$page = "cek_data";
include "template/sidebar.php";
include "functions/function.php";

if (isset($_SESSION["msg"])) {
    alert("Data Pemilik berhasil dimasukkan");
    session_unset($_SESSION["msg"]);
}

// id untuk data pemilik, jika tidak ada maka kembali ke cek_data.php
// if (!isset($_GET["id"])) {
//     echo "<script>
//     alert('ID tidak ditemukan');
//     document.location.href = 'cek_data.php';
//     </script>";
// } 

// cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {

    // cek apakah data pasien berhasil ditambahkan
    if (tambahPasien($_POST) > 0) {
        echo "<script>
        alert('Data Pasien berhasil dimasukkan');
        document.location.href = 'data_pasien.php';
        </script>";
    } else {
        die(mysqli_error($conn));
    }
}

?>
            <div id="layoutSidenav_content">
                <main>
                    <!-- masukkan nama pemilik -->

                    <!-- container -->
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Daftar Pasien</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="" method="post"> 
                                    <div class="p-2">
                                        <!-- nama pasien -->
                                        <div class="pb-2">
                                            <label for="pasien" class="form-label">Nama Hewan</label>
                                            <input type="text" class="form-control" name="pasien" aria-describedby="text" required>
                                        </div>
                                        <!-- jenis -->
                                        <div class="pb-2">
                                            <label for="jenis" class="form-label">Jenis Hewan / Ras</label>
                                            <input type="text" class="form-control" name="jenis" aria-describedby="text" required>
                                        </div>
                                        <!-- kelamin -->
                                        <div class="pb-2">
                                            <p>Jenis Kelamin :</p>
                                            <input type="radio" id="jantan" name="kelamin" value="jantan">
                                            <label for="jantan">Jantan</label><br>
                                            <input type="radio" id="betina" name="kelamin" value="betina">
                                            <label for="betina">Betina</label><br>
                                        </div>
                                        <!-- warna -->
                                        <div class="pb-4">
                                            <label for="warna" class="form-label">Warna</label>
                                            <input type="text" class="form-control" name="warna" aria-describedby="text" required>
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