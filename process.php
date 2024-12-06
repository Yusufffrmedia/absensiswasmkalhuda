<?php
header('Content-Type: application/json');

// Koneksi ke database
$conn = new mysqli('sql203.infinityfree.com', 'if0_37864027', 'absensmk', 'if0_37864027_absen_siswa');

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Koneksi database gagal.']));
}

// Proses input
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

// Upload foto
$fotoName = $_FILES['foto']['name'];
$fotoTmp = $_FILES['foto']['tmp_name'];
$fotoPath = 'uploads/' . $fotoName;
move_uploaded_file($fotoTmp, $fotoPath);

// Insert data ke database
$tanggal = date('Y-m-d H:i:s');
$sql = "INSERT INTO absensi (nama, kelas, foto, tanggal) VALUES ('$nama', '$kelas', '$fotoPath', '$tanggal')";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        'success' => true,
        'data' => [
            'nama' => $nama,
            'kelas' => $kelas,
            'foto' => $fotoPath,
            'tanggal' => $tanggal,
        ]
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan ke database.']);
}
$conn->close();
?>