<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
$page = "index";
include "template/sidebar.php";
include "functions/function.php";


// cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {

    passID($_POST);

}

?>
            <div id="layoutSidenav_content">
                <main>
                    <!-- masukkan nama pemilik -->

                    <!-- container -->
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Diagnosa</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="mb-0">
                                    Masukkan nama pasien dan nama pemilik
                            </h3>
                                <form action="" method="post"> 
                                    <div class="py-2">
                                        <div class="pb-2">
                                            <label for="pasien" class="form-label">Nama Pasien</label>
                                            <input type="text" class="form-control" name="pasien" aria-describedby="text" required>
                                        </div>
                                        <div class="pb-4 ">
                                            <label for="pemilik" class="form-label">Nama Pemilik</label>
                                            <input type="tel" class="form-control" name="pemilik" aria-describedby="text" required>
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