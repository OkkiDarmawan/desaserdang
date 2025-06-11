<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/Lambang_Kabupaten_Bangka_Selatan.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="./assets/images/Lambang_Kabupaten_Bangka_Selatan.png" alt="" width="45">
                </a>
                <p class="text-center">Login Admin</p>
                <form method="post" action="admin-login.php">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                  </div>
              
                  <input type="submit" name="submit" value="Login" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>


<?php
include 'koneksi.php';
session_start();

if (isset($_POST['submit'])) {
    $usern = $_POST['username'];
    $passw = $_POST['password'];

    if (empty($usern) || empty($passw)) {
        echo "<script>alert('Username / Password Tidak Boleh Kosong')</script>";
        echo "<meta http-equiv='refresh' content='0; url=admin-login.php'>";
    } else {
        $sql = mysqli_query($koneksi, "SELECT * FROM login_admin WHERE un = '$usern' AND pw = '$passw'");
        $result = mysqli_fetch_array($sql);

        if ($result) {
            $_SESSION['username'] = $usern;
            echo "<script>alert('Anda Berhasil Login')</script>";
            echo "<meta http-equiv='refresh' content='0; url=index.php'>";
        } else {
            echo "<script>alert('Akun anda belum terdaftar di database')</script>";
            echo "<meta http-equiv='refresh' content='0; url=admin-login.php'>";
        }
    }
}
?>
