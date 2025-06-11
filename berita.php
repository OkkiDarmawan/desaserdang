<?php
include "config/koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY tanggal DESC");

if (!$query) {
  die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Berita</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <style>
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }

    .card {
      height: 100%;
    }

    .card-body {
      display: flex;
      flex-direction: column;
    }

    .card-title {
      font-size: 1rem;
      font-weight: bold;
      margin-bottom: 0.5rem;
    }

    .card-text {
      font-size: 0.875rem;
      color: #333;
      flex-grow: 1;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 4;
      /* jumlah baris isi yang ditampilkan */
      -webkit-box-orient: vertical;
    }

    .text-muted {
      font-size: 0.75rem;
      margin-top: 0.5rem;
      margin-bottom: 0.5rem;
    }

    .btn {
      margin-top: auto;
    }
  </style>



  <!-- =======================================================
  * Template Name: Nova
  * Template URL: https://bootstrapmade.com/nova-bootstrap-business-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="blog-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">

        <img src="assets/img/Lambang_Kabupaten_Bangka_Selatan.png" alt="">
        <h1 class="sitename">Desa Serdang</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Beranda<br></a></li>
          <li><a href="tentang.html">Tentang</a></li>
          <li><a href="aparatur.html">Aparatur</a></li>
          <li><a href="berita.php" class="active">Berita</a></li>
          <li class="dropdown"><a href="berita.php"><span>Kategori</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="berita.php">Berita</a></li>
              <li><a href="tempatwisata.php">Tempat Wisata</a></li>
              <li><a href="budaya.php">Budaya</a></li>
            </ul>
          </li>
          <li><a href="kontak.html">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/berita-gambar.png);">
      <div class="container">
        <h1>Berita</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Beranda</a></li>
            <li class="current">Berita</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Posts Section -->
          <section id="blog-posts" class="blog-posts section">

            <div class="container">
              <div class="row gy-4">

                <?php while ($data = mysqli_fetch_array($query)) : ?>
                  <div class="col-md-4 mb-4">
                    <div class="card h-100">
                      <img src="./admin/assets/images/berita/<?php echo $data['gambar']; ?>" class="card-img-top" alt="Gambar Berita" width="">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $data['judul']; ?></h5>
                        <p class="card-text"><?php echo substr($data['isi'], 0, 100); ?>...</p>
                        <p class="text-muted small"><?php echo date('d M Y', strtotime($data['tanggal'])); ?></p>
                        <a href="detail_berita.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm mt-2">Baca Selengkapnya</a>

                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>


              </div>
            </div>

          </section><!-- /Blog Posts Section -->

          <!-- Blog Pagination Section -->
          <section id="blog-pagination" class="blog-pagination section">


          </section><!-- /Blog Pagination Section -->

        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">


            <!-- Categories Widget -->
            <div class="categories-widget widget-item">

              <h3 class="widget-title">Kategori</h3>
              <ul class="mt-3">
                <li><a href="berita.php">Berita</a></li>
                <li><a href="tempatwisata.php">Tempat Wisata</a></li>
                <li><a href="budaya.php">Budaya</a></li>
              </ul>

            </div><!--/Categories Widget -->
            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">
              <h3 class="widget-title">Berita Terdahulu</h3>

              <?php
              include 'admin/koneksi.php';
              $beritaTerbaru = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC LIMIT 5");
              while ($row = mysqli_fetch_assoc($beritaTerbaru)) :
              ?>
                <div class="post-item d-flex mb-3">
                  <img src="./admin/assets/images/berita/<?= $row['gambar'] ?>" alt="" class="flex-shrink-0" style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;">
                  <div>
                    <h4 style="font-size: 15px;"><a href="detail_berita.php?id=<?= $row['id'] ?>"><?= $row['judul'] ?></a></h4>
                    <time datetime="<?= date('Y-m-d', strtotime($row['created_at'])) ?>">
                      <?= date('M j, Y', strtotime($row['created_at'])) ?>
                    </time>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>



          </div>

        </div>

      </div>
    </div>

  </main>

  <footer id="footer" class="footer light-background">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-about">
            <a href="index.php" class="logo d-flex align-items-center">
              <span class="sitename">Desa Serdang</span>
            </a>
            <p>Desa Serdang mengalami kemajuan yang cukup pesat di berbagai bidang, baik secara ekonomi, sosial budaya hingga ke sistem pemerintahan desa . Perkembangan tersebut semakin nyata dengan hadirnya Website Desa Serdang yang sudah online sehingga dapat di akses oleh masyarakat untuk mendapatkan informasi</p>
            <p>Kantor Desa :</p>
            <p>JL. RAYA BATAM DESA SERDANG</p>
            <p>Kec. Toboali, Kab. Bangka Selatan</p>
            <p>Kepulauan Bangka Belitung, 33783</p>


          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Tauntan Mudah</h4>
            <ul>
              <li><a href="index.php">Beranda</a></li>
              <li><a href="tentang.html">Tentang</a></li>
              <li><a href="aparatur.html">Aparatur</a></li>
              <li><a href="berita.php">Berita</a></li>
              <li><a href="kontak.html">Kontak</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Hubungi Kami</h4>
            <ul>
              <li><a href="https://api.whatsapp.com/send?phone=6282289689781">Okki Darmawan</a></li>
              <li><a href="https://api.whatsapp.com/send?phone=6281440064826">Davin Pramudia</a></li>
              <p><strong>Email:</strong> <span>davinpramudia30@gmail.com</span></p>
              <p><strong>Email:</strong> <span>okkidarmawan07@gmail.com</span></p>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Alamat kami</h4>
            <p>Jalan Pegarawan</p>
            <p>Jalan Balun Ijuk</p>
          </div>

        </div>
      </div>
    </div>

    <div class="container copyright text-center">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Okki Darmawan & Davin Pramudia</strong></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>