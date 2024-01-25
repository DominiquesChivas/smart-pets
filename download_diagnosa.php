<?php
require('fpdf/fpdf.php');
include "functions/function.php";

$id = $_GET["id"];

$query = "SELECT pemilik.nama_pemilik, pemilik.no_telp, pemilik.alamat, pasien.nama_pasien, pasien.jenis_ras, pasien.kelamin, pasien.warna, diagnosa.berat, diagnosa.suhu, diagnosa.status_vaksin, diagnosa.tanggal, keterangan.anamnesa, keterangan.st_present,keterangan.ab_palpasi, keterangan.aus_paru, keterangan.aus_jantung, keterangan.discharge, keterangan.kondisi_mkt, keterangan.limponodus, keterangan.m_mucosa, keterangan.pem_penunjang, keterangan.diagnosa, keterangan.treatment, keterangan.saran FROM diagnosa JOIN pasien ON diagnosa.id_pasien = pasien.id JOIN pemilik ON pemilik.id = pasien.id_pemilik JOIN keterangan ON keterangan.id = diagnosa.id_keterangan WHERE diagnosa.id = $id";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

$conv = strtotime($data["tanggal"]);
$tanggal = date('d-F-Y', $conv);

class PDF extends FPDF {
    function Header()
    {
        $this->Image("SM.png",15,6,30);
        $this->SetFont("Arial", "", 11);
        $this->Cell(80);
        $this->Cell(30,7,"PRAKTIK DOKTER HEWAN", 0, 1, "C");
        $this->Cell(80);
        $this->Cell(30,7,"Drh. Mita Andini", 0, 1, "C");
        $this->Cell(80);
        $this->Cell(30,7,"SIP 440/0007/DH/DPM-PTSP.PPJU/OL.23", 0, 1, "C");
        $this->Cell(80);
        $this->Cell(30,7,"Jl. Raya Jatiwaringin 143 Pondok Gede - Bekasi", 0, 1, "C");
        $this->Cell(80);
        $this->Cell(30,7,"Telp. 021-84991662, 84901062", 0, 1, "C");
        $this->Line(20, 45, 210-20, 45);
        $this->Ln();
    }
}


$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->Cell(190,10,'REKAM MEDIS PASIEN SMARTPETS', 0,2, 'C');
$pdf->SetTextColor(255,0,0);
$pdf->Cell(190,10,'Tanggal diperiksa: ' . $tanggal, 0,2, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->Ln();



// tabel
$pdf->Cell(95,10,'Data Pemilik', 1); // baris judul
$pdf->Cell(95,10,'Data Pasien', 1);
$pdf->Ln();
$pdf->Cell(47.5,10,'Nama Pemilik', 1); // baris 1
$pdf->Cell(47.5,10,ucwords($data["nama_pemilik"]), 1);
$pdf->Cell(47.5,10,'Nama Hewan', 1);
$pdf->Cell(47.5,10,ucwords($data["nama_pasien"]), 1);
$pdf->Ln();
$pdf->Cell(47.5,10,'No Telepon / HP', 1); // baris 2
$pdf->Cell(47.5,10,$data["no_telp"], 1);
$pdf->Cell(47.5,10,'Jenis Hewan / Ras', 1);
$pdf->Cell(47.5,10,ucwords($data["jenis_ras"]), 1);
$pdf->Ln();
$pdf->Cell(47.5,10,'Alamat', 1); // baris 3

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->MultiCell(47.5,10,ucfirst($data["alamat"]), "TRL", "L");

$pdf->SetXY($x + 47.5, $y);

$pdf->Cell(47.5,10,'Jenis Kelamin', 1);
$pdf->Cell(47.5,10,$data["kelamin"], 1);
$pdf->Ln();
$pdf->Cell(47.5,10,'', "LR"); // baris 4
$pdf->Cell(47.5,10,'', "LR");
$pdf->Cell(47.5,10,'Warna', 1);
$pdf->Cell(47.5,10,ucfirst($data["warna"]), 1);
$pdf->Ln();
$pdf->Cell(47.5,10,'', "LR"); // baris 5
$pdf->Cell(47.5,10,'', "LR");
$pdf->Cell(47.5,10,'Berat Badan', 1);
$pdf->Cell(47.5,10,$data["berat"] . " Kg", 1);
$pdf->Ln();
$pdf->Cell(47.5,10,'', "LR"); // baris 6
$pdf->Cell(47.5,10,'', "LR");
$pdf->Cell(47.5,10,'Suhu', 1);
$pdf->Cell(47.5,10,$data["suhu"] . " C", 1);
$pdf->Ln();
$pdf->Cell(47.5,10,'', "LRB"); // baris 7
$pdf->Cell(47.5,10,'', "LRB");
$pdf->Cell(47.5,10,'Status Vaksin', 1);
$pdf->Cell(47.5,10,ucfirst($data["status_vaksin"] . " Divaksin"), 1);
$pdf->Ln();
$pdf->Ln();


$pdf->Cell(190,10,'Anamnesa : ' . ucfirst($data["anamnesa"]), 0,2);
$pdf->Cell(190,10,'Status Present : ' . ucfirst($data["st_present"]), 0,2);
$pdf->Cell(190,10,'Abnormal Palpasi : ' . ucfirst($data["ab_palpasi"]), 0,2);
$pdf->Cell(190,10,'Auscultasi Paru - paru / Lung : ' . ucfirst($data["aus_paru"]), 0,2);
$pdf->Cell(190,10,'Auscultasi Jantung dan Pulpus : ' . ucfirst($data["aus_jantung"]), 0,2);
$pdf->Cell(190,10,'Discharge Hidung, Mata, Dll : ' . ucfirst($data["discharge"]), 0,2);
$pdf->Cell(190,10,'Kondisi Mulut / Kulit / Telinga : ' . ucfirst($data["kondisi_mkt"]), 0,2);
$pdf->Cell(190,10,'Limponodus : ' . ucfirst($data["limponodus"]), 0,2);
$pdf->Cell(190,10,'Membrane Mucosa : ' . ucfirst($data["m_mucosa"]), 0,2);
$pdf->Cell(190,10,'Pemeriksaan Penunjang : ' . ucfirst($data["pem_penunjang"]), 0,2);
$pdf->Cell(190,10,'Diagnosa : ' . ucfirst($data["diagnosa"]), 0,2);
$pdf->Cell(190,10,'Treatment : ' . ucfirst($data["treatment"]), 0,2);
$pdf->Ln();
$pdf->Cell(190,10,'Saran : ' . ucfirst($data["saran"]), 0,2);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(120);
$pdf->Cell(47.5,10, "Tanda Tangan", 0,2, "C");
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(120);
$pdf->Cell(47.5,10, "(..............................)", 0,2, "R");

$pdf->Output("D", "Diagnosa " . $data["nama_pasien"] . "/" . $data["nama_pemilik"] . ".pdf");
?>