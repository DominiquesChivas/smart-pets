<?php

include "functions/function.php";


function hapusObat($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM obat WHERE id = $id");

    return mysqli_affected_rows($conn);
}

$id = $_GET["id"];

if (hapusObat($id) > 0) {
    echo "
    <script>
    alert('Hapus data berhasil');
    document.location.href = 'data_obat.php';
    </script>
    "; 
} else {
    echo "
    <script>
    alert('Hapus data gagal');
    document.location.href = 'data_obat.php';
    </script>
    "; 
}

?>