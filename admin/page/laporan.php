<?php
include 'koneksi.php';

if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $id = $_GET['id'];
        $sql = mysqli_query($koneksi, "DELETE FROM laporan WHERE id = '$id'");
        if ($sql) {
            echo 'Berhasil Hapus Data Guru';
        } else {
            echo 'Gagal Hapus Data Guru';
        }
    }
}

$query = mysqli_query($koneksi, "SELECT * FROM laporan ORDER BY id DESC");
?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Daftar Laporan</h4>
    <div class="table-responsive">
      <table class="table table-bordered table-hover w-100">
        <thead class="table-dark">
          <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 20%;">Nama</th>
            <th style="width: 25%;">Email</th>
            <th style="width: 35%;">Deskripsi</th>
            <th style="width: 15%;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$row['nama']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['deskripsi']}</td>";
            echo "<td>
                    <a href='index.php?page=edit_laporan&id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                    <a href='index.php?page=laporan&action=hapus&id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                  </td>";
            echo "</tr>";
            $no++;
          }

          if (mysqli_num_rows($query) == 0) {
            echo "<tr><td colspan='5' class='text-center'>Belum ada data laporan.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
