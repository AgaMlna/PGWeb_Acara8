<!DOCTYPE html>
<html>
<head>
    <title>Form Input Data</title>
</head>
<body>
<h2>Form Input</h2>
<form action="/pgweb/pgweb_acara8/7b/input.php" onsubmit="return validateForm()" method="post">
    <label for="kecamatan">Kecamatan:</label><br>
    <input type="text" id="kecamatan" name="kecamatan" value=""><br>
    <label for="longitude">Longitude:</label><br>
    <input type="text" id="longitude" name="longitude" value=""><br>
    <label for="latitude">Latitude:</label><br>
    <input type="text" id="latitude" name="latitude" value=""><br>
    <label for="luas">Luas:</label><br>
    <input type="text" id="luas" name="luas" value=""><br>
    <label for="jumlah_penduduk">Jumlah Penduduk:</label><br>
    <input type="text" id="jumlah_penduduk" name="jumlah_penduduk" value=""><br><br>
    <input type="submit" value="Submit">
</form>

<p id="informasi"></p>

<!-- Tabel untuk menampilkan data -->
<h2>Data Penduduk</h2>
<table border ="1">
    <tr>
        <th>Kecamatan</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Luas</th>
        <th>Jumlah Penduduk</th>
        <th>Aksi</th>
    </tr>
    <?php
    // Koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = ""; // Ganti dengan password MySQL Anda jika ada
    $dbname = "pgweb_acara8";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Mengambil data dari tabel penduduk
    $sql = "SELECT * FROM penduduk";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["kecamatan"]."</td>
                    <td>".$row["longitude"]."</td>
                    <td>".$row["latitude"]."</td>
                    <td>".$row["luas"]."</td>
                    <td align='right'>".$row["jumlah_penduduk"]."</td>
                    <td><a href='/pgweb/pgweb_acara8/7b/delete.php?id=".$row["id"]."'>Delete</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
    }

    $conn->close();
    ?>
</table>

<script>
function validateForm() {
    let luas = document.getElementById("luas").value;
    let kecamatan = document.getElementById("kecamatan").value;
    let jumlahPenduduk = document.getElementById("jumlah_penduduk").value;
    let text = "";
    if (isNaN(luas) || luas < 1) {
        text += "Data luas harus angka dan tidak boleh bernilai negatif.<br>";
    }
    if (kecamatan.trim() === "") {
        text += "Data kecamatan tidak boleh kosong.<br>";
    }
    if (isNaN(jumlahPenduduk) || jumlahPenduduk < 1) {
        text += "Data jumlah penduduk harus angka dan tidak boleh bernilai negatif.<br>";
    }
    document.getElementById("informasi").innerHTML = text;
    return text === ""; // Hanya submit jika tidak ada pesan kesalahan
}
</script>
</body>
</html>
