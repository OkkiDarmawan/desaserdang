<?php
include "koneksi.php"; // Pastikan koneksi.php mengarah ke DB dengan tabel 'laporan'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $deskripsi = htmlspecialchars($_POST['message']);

    // Simpan ke database
    $query = "INSERT INTO laporan (nama, email, deskripsi) VALUES ('$nama', '$email', '$deskripsi')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Laporan berhasil dikirim. Terima kasih!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Gagal mengirim laporan. Silakan coba lagi.'); window.history.back();</script>";
    }
} else {
    echo "Akses tidak valid!";
}
?>
