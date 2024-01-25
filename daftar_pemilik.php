<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
include "template/sidebar.php";
include "functions/function.php";

// cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
    global $conn;

    
    if (tambahPemilik($_POST) > 0) {
        echo "<script>
        document.location.href = 'daftar_pasien.php';
        alert('Data berhasil dimasukkan')
        </script>" ;
    } else {
        alert("Data gagal dimasukkan");
        echo mysqli_error($conn);
    }
    

}

?>
            <div id="layoutSidenav_content">
                <main>
                    <!-- masukkan nama pemilik -->

                    <!-- container -->
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Daftar Pemilik</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="" method="post"> 
                                    <div class="p-2">
                                        <div class="pb-2">
                                            <label for="pemilik" class="form-label">Nama Pemilik</label>
                                            <input type="text" class="form-control" name="pemilik" aria-describedby="text">
                                        </div>
                                        <div class="pb-2">
                                            <label for="notelp" class="form-label">Nomor Telepon / HP</label>
                                            <input type="tel" class="form-control" name="notelp" aria-describedby="text">
                                        </div>
                                        <div class="pb-4">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" name="alamat" aria-describedby="text">
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