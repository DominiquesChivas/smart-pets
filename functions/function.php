<?php 

// koneksi database
$conn = mysqli_connect("localhost", "root", "", "smart_pets");

function alert($msg) {
    echo "<script>alert('$msg');</script>";
}

function registrasi($data) {
    global $conn;

    $nama = htmlspecialchars(strtolower($data["nama"]));
    $username = htmlspecialchars(strtolower($data["username"]));
    $jabatan = htmlspecialchars(strtolower($data["jabatan"]));
    $password = mysqli_real_escape_string($conn, $data["password1"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek apakah username atau nama sudah ada
    $result1 = mysqli_query($conn, "SELECT nama_admin FROM admin WHERE nama_admin = '$nama'");
    $result2 = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");

    if (mysqli_fetch_assoc($result1)) {
        echo "<script>
        alert('Nama atau Username sudah ada!');
        document.location.href = 'registrasi.php';
        </script>";
        exit;
    }

    if (mysqli_fetch_assoc($result2)) {
        echo "<script>
        alert('Nama atau Username sudah ada!');
        document.location.href = 'registrasi.php';
        </script>";
        exit;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('Password tidak cocok');
        document.location.href = 'registrasi.php';
        </script>";
        exit;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan admin ke database
    mysqli_query($conn, "INSERT INTO admin VALUE(
        '', '$nama', '$username', '$password', '$jabatan'
    )");

    return mysqli_affected_rows($conn);

}


function pemilik($data) {
    // menentukan ada atau tidaknya data pemilik, jika belum ada maka tambahkan, jika sudah ada maka dilanjutkan ke halaman daftar_pasien.php
    global $conn;

    $nama = htmlspecialchars(strtolower($data["pemilik"]));
    $no = htmlspecialchars(strtolower($data["notelp"]));

    // cek apa nama pemilik dan nomor telepon sudah ada
    $result1 = mysqli_query($conn, "SELECT * FROM pemilik WHERE nama_pemilik = '$nama'");
    $result2 = mysqli_query($conn, "SELECT no_telp FROM pemilik WHERE no_telp = '$no'");
    $id = mysqli_fetch_array(mysqli_query($conn, "SELECT id FROM pemilik WHERE nama_pemilik = '$nama'"))[0];

    if ((mysqli_fetch_assoc($result1)) && (mysqli_fetch_assoc($result2))) {

        echo "<script>
        alert('Silahkan daftarkan Pasien');
        </script>";
        header("Location: daftar_pasien.php?id=" . $id);
        return false;
    } else {
        echo "<script>
        alert('Silahkan daftarkan Pemilik');
        document.location.href = 'daftar_pemilik.php';
        </script>";
        return false;
    }

}

function passID($data) {
    global $conn;

    $pasien = htmlspecialchars(strtolower($data["pasien"]));
    $pemilik = htmlspecialchars(strtolower($data["pemilik"]));

    $result1 = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien = '$pasien'");
    $result2 = mysqli_query($conn, "SELECT * FROM pemilik WHERE nama_pemilik = '$pemilik'");
    $id = mysqli_fetch_array(mysqli_query($conn, "SELECT id FROM pasien WHERE nama_pasien = '$pasien'"))[0];

    if ((mysqli_fetch_assoc($result1)) && (mysqli_fetch_assoc($result2))) {
        header("Location: diagnosa.php?id=" . $id);
    } else {
        echo "<script>
        alert('Pasien atau Pemilik belum terdaftar, silahkan daftar!');
        document.location.href = 'cek_data.php';
        </script>";
    }
}

function tambahPemilik($data) {
    global $conn;

    $nama = htmlspecialchars(strtolower($data["pemilik"]));
    $hp = htmlspecialchars(strtolower($data["notelp"]));
    $alamat = htmlspecialchars(strtolower($data["alamat"]));

    // query insert data
    $query = "INSERT INTO pemilik VALUES 
    ('', '$nama', '$hp', '$alamat')
    ";

    mysqli_query($conn, $query);

    // ambil ID untuk halaman daftar_pasien
    $queryID = "SELECT * FROM pemilik WHERE nama_pemilik = '$nama'";
    $tampilID = mysqli_query($conn, $queryID);
    $id = mysqli_fetch_array($tampilID)[0];
    $_SESSION["id_pemilik"] = $id;

    return mysqli_affected_rows($conn);
    
}

function tambahPasien($data) {
    global $conn ;

    // ambil id pemilik
    $id = $_GET["id"];

    $nama = htmlspecialchars(strtolower($data["pasien"]));
    $jenis = htmlspecialchars(strtolower($data["jenis"]));
    $kelamin = htmlspecialchars(strtolower($data["kelamin"]));
    $warna = htmlspecialchars(strtolower($data["warna"]));
    $id = $_SESSION["id_pemilik"];

    // SELECT TOP 1 id FROM pemilik ORDER BY id DESC

    // query insert data
    $query  = "INSERT INTO pasien VALUES
    ('', '$id', '$nama', '$jenis', '$kelamin', '$warna')
    ";

    mysqli_query($conn, $query);
    session_unset($id);

    return mysqli_affected_rows($conn);

}

function tambahObat($data) {
    global $conn;

    $nama = htmlspecialchars(strtolower($data["obat"]));
    $stok = htmlspecialchars(strtolower($data["stok"]));
    $harga = htmlspecialchars($data["harga"]);

    // cek apakah data obat sudah ada
    // ambil nama obat dari database
    $obat = mysqli_fetch_array(mysqli_query($conn, "SELECT nama_obat FROM obat WHERE nama_obat = '$nama'"))[0];

    if ($nama == $obat) {
        alert("Data obat sudah ada");
        echo "<script>
        document.location.href = 'daftar_obat.php';
        </script>" ;

        exit();
    } else {
    
    // query insert data
    $query = "INSERT INTO obat VALUES 
    ('', '$nama', '$stok', '$harga')
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    }
}

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

?>