<?php
include 'koneksi.php';

// Proses hapus berita
if (isset($_GET['action']) && $_GET['action'] == "hapus") {
    $id = $_GET['id'];

    // Hapus gambar dari server (jika ada)
    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT gambar FROM berita WHERE id = '$id'"));
    if ($data && file_exists("gambar_berita/" . $data['gambar'])) {
        unlink("./assets/images/berita/" . $data['gambar']);
    }

    // Hapus dari DB
    $sql = mysqli_query($koneksi, "DELETE FROM berita WHERE id = '$id'");
    echo $sql ? 'Berhasil Hapus Berita' : 'Gagal Hapus Berita';
}

// Ambil semua berita
$query = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC");
?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title d-flex justify-content-between align-items-center">
      Daftar Berita
      <a href="index.php?page=postingan" class="btn btn-primary btn-sm">+ Tambah Berita</a>
    </h4>

    <div class="table-responsive mt-3">
      <table class="table table-bordered table-hover w-100">
        <thead class="table-dark">
          <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 15%;">Gambar</th>
            <th style="width: 25%;">Judul</th>
            <th style="width: 40%;">Isi</th>
            <th style="width: 15%;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while ($row = mysqli_fetch_assoc($query)) {
            $isi_singkat = substr(strip_tags($row['isi']), 0, 100) . '...';
            $gambar_path = $row['gambar'] ? "./assets/images/berita/" . $row['gambar'] : "noimage.jpg";

            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td><img src='{$gambar_path}' alt='Gambar' style='width: 100px; height: auto;'></td>";
            echo "<td>{$row['judul']}</td>";
            echo "<td>{$isi_singkat}</td>";
            echo "<td>
                    <a href='index.php?page=edit_berita&id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                    <a href='index.php?page=berita&action=hapus&id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus berita ini?')\">Hapus</a>
                  </td>";
            echo "</tr>";
            $no++;
          }

          if (mysqli_num_rows($query) == 0) {
            echo "<tr><td colspan='5' class='text-center'>Belum ada berita yang diposting.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
