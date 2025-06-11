<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM berita WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    // Cek apakah user upload gambar baru
    if ($_FILES['gambar']['name']) {
        $namaFile = $_FILES['gambar']['name'];
        $tmpFile = $_FILES['gambar']['tmp_name'];
        $folder = 'gambar_berita/';
        $pathBaru = $folder . $namaFile;

        // Hapus gambar lama jika ada
        if ($data['gambar'] && file_exists($folder . $data['gambar'])) {
            unlink($folder . $data['gambar']);
        }

        // Pindahkan file baru
        move_uploaded_file($tmpFile, $pathBaru);

        // Update DB dengan gambar baru
        $sql = mysqli_query($koneksi, "UPDATE berita SET judul='$judul', isi='$isi', gambar='$namaFile' WHERE id='$id'");
    } else {
        // Tanpa ubah gambar
        $sql = mysqli_query($koneksi, "UPDATE berita SET judul='$judul', isi='$isi' WHERE id='$id'");
    }

    if ($sql) {
        echo "<script>alert('Berhasil mengupdate berita'); window.location='index.php?page=berita';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate berita');</script>";
    }
}
?>

<h4>Edit Berita</h4>

<form method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label>Judul</label>
    <input type="text" name="judul" class="form-control" value="<?= $data['judul'] ?>" required>
  </div>

  <div class="mb-3">
    <label>Isi Berita</label>
    <textarea name="isi" class="form-control" rows="6" required><?= $data['isi'] ?></textarea>
  </div>

  <div class="mb-3">
    <label>Gambar Saat Ini</label><br>
    <?php if ($data['gambar']) : ?>
      <img src="./assets/images/berita/<?= $data['gambar'] ?>" width="150">
    <?php else : ?>
      <p><i>Tidak ada gambar</i></p>
    <?php endif; ?>
  </div>

  <div class="mb-3">
    <label>Ganti Gambar (jika perlu)</label>
    <input type="file" name="gambar" class="form-control">
  </div>

  <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
  <a href="index.php?page=berita" class="btn btn-secondary">Batal</a>
</form>
