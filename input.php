<?php
$kecamatan = $_POST['kecamatan'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];

// Sesuaikan dengan setting MySQL
$servername = "localhost";
$username = "root";
$password = ""; // Ganti dengan password MySQL Anda jika ada
$dbname = "pgweb_acara8";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menyusun query SQL untuk memasukkan data
$sql = "INSERT INTO penduduk (kecamatan, longitude, latitude, luas, jumlah_penduduk)
VALUES ('$kecamatan', $longitude, $latitude, $luas, $jumlah_penduduk)";

if ($conn->query($sql) === TRUE) {
    echo "Data Telah Berhasil Ditambahkan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
