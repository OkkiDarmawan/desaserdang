<?php
include 'config/koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM berita WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo $data['judul']; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    .berita-detail {
      max-width: 800px;
      margin: 60px auto;
      padding: 30px;
      background-color: #ffffff;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      border-radius: 10px;
    }
    .berita-detail img {
      max-width: 100%;
      height: auto;
      margin: 20px 0;
      border-radius: 10px;
    }
    .kembali-btn {
      margin-top: 30px;
    }
  </style>
</head>
<body style="background-color: #f8f9fa;">

  <div class="container">
    <div class="berita-detail text-center">
      <h2 class="mb-3"><?php echo htmlspecialchars($data['judul']); ?></h2>
      <img src="./admin/assets/images/berita/<?php echo htmlspecialchars($data['gambar']); ?>" alt="Gambar Berita">
      <p class="text-start mt-4" style="text-align: justify;"><?php echo nl2br(htmlspecialchars($data['isi'])); ?></p>
      <a href="berita.php" class="btn btn-secondary kembali-btn">← Kembali ke Berita</a>
    </div>
  </div>

</body>
</html>
