<?php

include "functions/function.php";


function hapusPasien($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM pasien WHERE id = $id");

    return mysqli_affected_rows($conn);
}

$id = $_GET["id"];

if (hapusPasien($id) > 0) {
    echo "
    <script>
    alert('Hapus data berhasil');
    document.location.href = 'data_pasien.php';
    </script>
    "; 
} else {
    echo "
    <script>
    alert('Hapus data gagal');
    document.location.href = 'data_pasien.php';
    </script>
    "; 
}

?>