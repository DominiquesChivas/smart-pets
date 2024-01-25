<?php

include "functions/function.php";

function hapusPemilik($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM pemilik WHERE id = $id");

    return mysqli_affected_rows($conn);
}

$id = $_GET["id"];

if (hapusPemilik($id) > 0) {
    echo "
    <script>
    alert('Hapus data berhasil');
    document.location.href = 'data_pemilik.php';
    </script>
    "; 
} else {
    echo "
    <script>
    alert('Hapus data gagal');
    document.location.href = 'data_pemilik.php';
    </script>
    "; 
}

?>