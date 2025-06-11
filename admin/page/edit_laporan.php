<?php
include 'koneksi.php';

if (isset($_POST['edit_laporan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $deskripsi = $_POST['deskripsi'];

    if (empty($nama) || empty($email) || empty($deskripsi)) {
        echo '<div class="warning">Data Tidak Boleh Kosong</div>';
    } else {
        $edit = mysqli_query($koneksi, "UPDATE laporan SET 
            nama = '$nama',
            email = '$email',
            deskripsi = '$deskripsi'
            WHERE id = '$id'");

        if ($edit) {
            echo '<div class="success">Berhasil Ubah Data Laporan</div>';
        } else {
            echo '<div class="error">Gagal Ubah Data Laporan</div>';
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM laporan WHERE id = '$id'");
    $result = mysqli_fetch_array($sql);
} else {
    echo "<div class='error'>ID laporan tidak ditemukan.</div>";
    exit;
}
?>

<h4>Edit Laporan</h4>
<form action="" method="POST">
  <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
  <div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" value="<?php echo $result['nama']; ?>" required>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="<?php echo $result['email']; ?>" required>
  </div>
  <div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="deskripsi" class="form-control" required><?php echo $result['deskripsi']; ?></textarea>
  </div>
  <button type="submit" name="edit_laporan" class="btn btn-primary">Update</button>
  <a href="index.php?page=laporan" class="btn btn-secondary">Kembali</a>
</form>
