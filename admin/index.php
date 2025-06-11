<?php
session_start();
include 'koneksi.php'; // koneksi ke MySQL

$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$waktu = date('Y-m-d H:i:s');
$tanggal = date('Y-m-d');

// Cek apakah IP sudah tercatat hari ini
$cek = mysqli_query($koneksi, "SELECT * FROM pengunjung1 WHERE ip_address = '$ip' AND DATE(waktu_kunjungan) = '$tanggal'");

if (mysqli_num_rows($cek) == 0) {
  // Jika belum tercatat, simpan ke database
  mysqli_query($koneksi, "INSERT INTO pengunjung1 (ip_address, user_agent, waktu_kunjungan)
    VALUES ('$ip', '$agent', '$waktu')");
}

// Hitung total pengunjung
$result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengunjung1");
$data = mysqli_fetch_assoc($result);
$totalPengunjung = $data['total'];


if (isset($_SESSION['username'])) {
?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Desa Serdang</title>
    <link rel="shortcut icon" type="image/png" href="./assets/images/Lambang_Kabupaten_Bangka_Selatan.png" />
    <link rel="stylesheet" href="./assets/css/styles.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css">
  </head>

  <body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed">
      <!--  App Topstrip -->
      <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0 ">
          <h5 class="text-white">Selamat Datang</h5>
        </div>

        <div class="d-lg-flex align-items-center gap-2">
          <h3 class="text-white mb-2 mb-lg-0 fs-5 text-center">
            Halaman Admin
          </h3>

        </div>
      </div>
      <!-- Sidebar Start -->
      <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
          <div class="brand-logo d-flex align-items-center justify-content-center text-center gap-4">
            <img src="./assets/images/Lambang_Kabupaten_Bangka_Selatan.png" alt="" width="45" />
            <h5 class="text-center d-flex text-black">Desa Serdang</h5>
          </div>
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
              <li class="nav-small-cap">
                <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                <span class="hide-menu">Beranda</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="index.php?page=home" aria-expanded="false">
                  <i class="ti ti-atom"></i>
                  <span class="hide-menu">Dasbor</span>
                </a>
              </li>
              <!-- ---------------------------------- -->
              <!-- Dashboard -->
              <!-- ---------------------------------- -->
              <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" href="index.php?page=berita" aria-expanded="false">
                  <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                      <i class="ti ti-aperture"></i>
                    </span>
                    <span class="hide-menu">Postingan</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" href="index.php?page=laporan" aria-expanded="false">
                  <div class="d-flex align-items-center gap-3">

                    <span class="d-flex">
                      <i class="ti ti-report"></i>

                    </span>
                    <span class="hide-menu">Laporan</span>
                  </div>
                </a>
              </li>
            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!--  Sidebar End -->
      <!--  Main wrapper -->
      <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
          <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
              <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                  <i class="ti ti-menu-2"></i>
                </a>
              </li>
            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
              <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                  <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="./assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle" />
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                    <div class="message-body">

                      <a href="index.php?page=logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
        </header>
        <!--  Header End -->
        <div class="body-wrapper-inner">
          <div class="container-fluid">
            <!--  Row 1 -->
            <div class="row">
              <div class="col-md-12">

                <?php
                $halaman = isset($_GET['page']) ? $_GET['page'] : "";

                // Atur ukuran kolom berdasarkan halaman
                $colClass = ($halaman == "" || $halaman == "home") ? "col-md-4" : "col-md-12";
                ?>

                <div class="<?php echo $colClass; ?>">
                  <?php
                  if ($halaman == "") {
                    include "page/home.php";
                  } else if (!file_exists("page/$halaman.php")) {
                    echo "Halaman tidak ditemukan";
                  } else {
                    include "page/$halaman.php";
                  }
                  ?>


                </div>
              </div>

              <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">
                  Desain dan Pengembang Oleh
                  <a href="#" class="pe-1 text-primary text-decoration-underline">Davin X Okki</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
      <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="./assets/js/sidebarmenu.js"></script>
      <script src="./assets/js/app.min.js"></script>
      <script src="./assets/libs/apexcharts/dist/apexcharts.min.js"></script>
      <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
      <script src="./assets/js/dashboard.js"></script>
      <!-- solar icons -->
      <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  </body>

  </html>
<?php
} else {
  echo "<meta http-equiv='refresh' content='0 url=./admin-login.php'>";
}
?>