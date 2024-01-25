<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
$page = "index";
include "template/sidebar.php";
include "functions/function.php";

// id pasien
$id = $_GET["id"];


// cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
    global $conn;

    $berat = htmlspecialchars($_POST["berat"]);
    $suhu = htmlspecialchars($_POST["suhu"]);
    $status = $_POST["status"];
    $tanggal = date("Y-m-d");
    $anam = htmlspecialchars(strtolower($_POST["anam"]));
    $st_p = htmlspecialchars(strtolower($_POST["st_p"]));
    $ab_pal = htmlspecialchars(strtolower($_POST["ab_pal"]));
    $aus_lung = htmlspecialchars(strtolower($_POST["aus_lung"]));
    $aus_heart = htmlspecialchars(strtolower($_POST["aus_heart"]));
    $dis = htmlspecialchars(strtolower($_POST["dis"]));
    $kondisi_mkt = htmlspecialchars(strtolower($_POST["kondisi_mkt"]));
    $lim = htmlspecialchars(strtolower($_POST["lim"]));
    $mm = htmlspecialchars(strtolower($_POST["mm"]));
    $pp = htmlspecialchars(strtolower($_POST["pp"]));
    $diag = htmlspecialchars(strtolower($_POST["diag"]));
    $obat = htmlspecialchars(strtolower($_POST["obat"]));
    $treat = htmlspecialchars(strtolower($_POST["treat"]));
    $saran = htmlspecialchars(strtolower($_POST["saran"]));


    // query insert data ke tabel keterangan
    $ket = "INSERT INTO keterangan VALUES 
    ('', '$anam', '$st_p', '$ab_pal', '$aus_lung', '$aus_heart', '$dis', '$kondisi_mkt', '$lim', '$mm', '$pp', '$diag', '$treat', '$saran')";

    mysqli_query($conn, $ket);

    $id_ket = mysqli_insert_id($conn);
    
    // query insert data ke tabel diagnosa
    $d = "INSERT INTO diagnosa VALUES 
    ('', '$id', '$id_ket', '$suhu', '$status', '$tanggal', $berat )";

    mysqli_query($conn, $d);

    // query insert data ke tabel riwayat penyakit
    $riw_p = "INSERT INTO riwayat_penyakit VALUES
    ('', '$id', '$diag', '$treat', '$tanggal')";

    mysqli_query($conn, $riw_p);

    // query insert data ke tabel riwayat obat
    // jika diberi obat
    if (is_null($obat) > 0) {
        $riw_o = "INSERT INTO riwayat_obat VALUES
        ('', '$id', '$obat', '$tanggal')";

        mysqli_query($conn, $riw_o);
    }


    if (mysqli_affected_rows($conn) > 0) {
        alert("Data berhasil Diinput");
        echo "<script>
        document.location.href = 'data_diagnosa.php';
        </script>";
    } else {
        alert("Data gagal Diinput");
        echo "<script>
        document.location.href = 'index.php';
        </script>";
    }

}

?>
            <div id="layoutSidenav_content">
                <main>
                    <!-- masukkan nama pemilik -->

                    <!-- container -->
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pemeriksaan</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="" method="post"> 
                                    <div class="py-2">
                                        <!-- Berat Badan -->
                                        <p class="mb-2">Berat Badan</p>
                                        <div class="input-group pb-4">
                                            <span class="input-group-text" id="basic-addon1">Kg</span>
                                            <input type="number" class="form-control" aria-label="berat" aria-describedby="basic-addon1" name="berat" required>
                                        </div>
                                        <!-- Suhu Tubuh -->
                                        <p class="mb-2">Suhu Tubuh</p>
                                        <div class="input-group pb-4">
                                            <span class="input-group-text" id="basic-addon1">℃</span>
                                            <input type="number" class="form-control" aria-label="suhu" aria-describedby="basic-addon1" name="suhu" step="any" min="0" required>
                                        </div>
                                        <!-- status_v -->
                                        <div class="pb-4">
                                            <p>Status Vaksin :</p>
                                            <input type="radio" id="sudah" name="status" value="sudah">
                                            <label for="sudah">Sudah Divaksin</label><br>
                                            <input type="radio" id="belum" name="status" value="belum">
                                            <label for="belum">Belum Divaksin</label><br>
                                        </div>
                                        <!-- Anamnesa -->
                                        <div class="pb-4 ">
                                            <label for="anam" class="form-label">Anamnesa</label>
                                            <input type="text" class="form-control" name="anam" aria-describedby="text" >
                                        </div>
                                        <!-- Status Present -->
                                        <div class="pb-4 ">
                                            <label for="st_p" class="form-label">Status Present</label>
                                            <input type="text" class="form-control" name="st_p" aria-describedby="text" >
                                        </div>
                                        <!-- Abnormal Palpasi -->
                                        <div class="pb-4 ">
                                            <label for="ab_pal" class="form-label">Abnormal Palpasi</label>
                                            <input type="text" class="form-control" name="ab_pal" aria-describedby="text" >
                                        </div>
                                        <!-- Auscultasi Paru - Paru / Lung -->
                                        <div class="pb-4 ">
                                            <label for="aus_lung" class="form-label">Auscultasi Paru - Paru / Lung</label>
                                            <input type="text" class="form-control" name="aus_lung" aria-describedby="text" >
                                        </div>
                                        <!-- Auscultasi Jantung -->
                                        <div class="pb-4 ">
                                            <label for="aus_heart" class="form-label">Auscultasi Jantung</label>
                                            <input type="text" class="form-control" name="aus_heart" aria-describedby="text" >
                                        </div>
                                        <!-- Discharge Hidung, Mata, dll -->
                                        <div class="pb-4 ">
                                            <label for="dis" class="form-label">Discharge Hidung, Mata, dll</label>
                                            <input type="text" class="form-control" name="dis" aria-describedby="text" >
                                        </div>
                                        <!-- Kondisi Mulut, Kulit, Telinga -->
                                        <div class="pb-4 ">
                                            <label for="kondisi_mkt" class="form-label">Kondisi Mulut, Kulit, Telinga</label>
                                            <input type="text" class="form-control" name="kondisi_mkt" aria-describedby="text" >
                                        </div>
                                        <!-- Limponodus -->
                                        <div class="pb-4 ">
                                            <label for="lim" class="form-label">Limponodus</label>
                                            <input type="text" class="form-control" name="lim" aria-describedby="text" >
                                        </div>
                                        <!-- Membrane Mucosa -->
                                        <div class="pb-4 ">
                                            <label for="mm" class="form-label">Membrane Mucosa</label>
                                            <input type="text" class="form-control" name="mm" aria-describedby="text" >
                                        </div>
                                        <!-- Pemeriksaan Penunjang -->
                                        <div class="pb-4 ">
                                            <label for="pp" class="form-label">Pemeriksaan Penunjang</label>
                                            <input type="text" class="form-control" name="pp" aria-describedby="text" >
                                        </div>
                                        <!-- Diagnosa -->
                                        <div class="pb-4 ">
                                            <label for="diag" class="form-label">Diagnosa</label>
                                            <input type="text" class="form-control" name="diag" aria-describedby="text" required>
                                        </div>
                                        <!-- pemberian obat -->
                                        <div class="pb-4 ">
                                            <label for="obat" class="form-label">Pemberian Obat</label>
                                            <input type="text" class="form-control" name="obat" aria-describedby="text">
                                        </div>
                                        <!-- Treatment -->
                                        <div class="pb-4 ">
                                            <label for="treat" class="form-label">Treatment</label>
                                            <input type="text" class="form-control" name="treat" aria-describedby="text" required>
                                        </div>
                                        <!-- Saran -->
                                        <div class="pb-4 ">
                                            <label for="saran" class="form-label">Saran</label>
                                            <input type="text" class="form-control" name="saran" aria-describedby="text" required>
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