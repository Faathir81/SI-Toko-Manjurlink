<?php

@include 'shopping cart/config.php';


session_start();

if(!isset($_SESSION['user_name'])){
   header('location:/login%20system/login_form.php');
}

if(isset($_POST['add_to_cart'])){

  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = 1;

  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

  if(mysqli_num_rows($select_cart) > 0){
     $message[] = 'product already added to cart';
  }else{
     $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
     $message[] = 'product added to cart succesfully';
  }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Manjurlink</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico" />

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/templatemo.css" />
    <link rel="stylesheet" href="assets/css/custom.css" />

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
  </head>
  <body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
          <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">Manjurlink</a>

          <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
              <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
              </div>
              <div class="navbar align-self-center d-flex">
                <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                    <div class="input-group">
                      <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ..." />
                      <div class="input-group-text">
                          <i class="fa fa-fw fa-search"></i>
                      </div>
                    </div>
                </div>
                <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                    <i class="fa fa-fw fa-search text-dark mr-2"></i>
                </a>
                <a href="/shopping cart/cart.php" class="nav-icon position-relative text-decoration-none">
                  <?php
                  $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                  $row_count = mysqli_num_rows($select_rows);
                  ?>
                  <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                  <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"><?php echo $row_count; ?></span>
                </a>
                <a class="nav-icon position-relative text-decoration-none" href="#">
                  <span><?php echo $_SESSION['user_name'] ?></span>
                </a>
                <a class="nav-icon position-relative text-decoration-none" href="login%20system/logout.php">Logout</a>
              </div>
          </div>
        </div>
    </nav>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="w-100 pt-1 mb-5 text-right">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="get" class="modal-content modal-body border-0 p-0">
          <div class="input-group mb-2">
            <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ..." />
            <button type="submit" class="input-group-text bg-success text-light">
              <i class="fa fa-fw fa-search text-white"></i>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
      <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container">
            <div class="row p-5">
              <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                <img class="img-fluid rounded-3" src="/assets/img/RPL/beras-1.jpg" alt="" />
              </div>
              <div class="col-lg-6 mb-0 d-flex align-items-center">
                <div class="text-align-left align-self-center">
                  <h1 class="h1 text-success"><b>Manjur</b> Link</h1>
                  <h3 class="h2">Beras</h3>
                  <p>Nikmati nasi pulen dan harum dengan Beras Pandan Wangi berkualitas premium. Diskon 10% untuk pembelian bulan ini!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row p-5">
              <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                <img class="img-fluid rounded-3" src="/assets/img/RPL/gula.jpg" alt="" />
              </div>
              <div class="col-lg-6 mb-0 d-flex align-items-center">
                <div class="text-align-left">
                  <h1 class="h1">Gulaku</h1>
                  <h3 class="h2">Gula</h3>
                  <p>Gula pasir murni untuk berbagai keperluan dapur Anda. Harga spesial hanya di Toko Agen Manjurlink!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row p-5">
              <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                <img class="img-fluid rounded-3" src="/assets/img/RPL//minyak.jpg" alt="" />
              </div>
              <div class="col-lg-6 mb-0 d-flex align-items-center">
                <div class="text-align-left">
                  <h1 class="h1">Bimoli</h1>
                  <h3 class="h2">Minyak</h3>
                  <p>Minyak goreng berkualitas tinggi untuk memasak sehat dan lezat. Beli 5 gratis 1! Promo berlaku hingga akhir bulan.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
      </a>
      <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
      </a>
    </div>
    <!-- End Banner Hero -->

    <!-- Start Categories of The Month -->
    <section class="container py-5">
      <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
          <h1 class="h1">Barang Terlaris Bulanan</h1>
          <p>
            Produk-produk yang paling diminati dan paling banyak terjual setiap bulannya, dipilih berdasarkan data penjualan terbaru. Dapatkan diskon spesial dan manfaatkan penawaran eksklusif untuk barang-barang favorit pelanggan kami
            bulan ini!
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-4 p-5 mt-3">
          <a href="#"><img src="/assets/img/RPL/mie.jpg" class="rounded-circle img-fluid border" /></a>
          <h5 class="text-center mt-3 mb-3">Mie Indomie</h5>
          <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
          <a href="#"><img src="/assets/img/RPL/aqua.jpg" class="rounded-circle img-fluid border" /></a>
          <h2 class="h5 text-center mt-3 mb-3">Aqua</h2>
          <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
          <a href="#"><img src="/assets/img/RPL/telur.jpg" class="rounded-circle img-fluid border" /></a>
          <h2 class="h5 text-center mt-3 mb-3">Telur</h2>
          <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
        </div>
      </div>
    </section>
    <!-- End Categories of The Month -->

    <!-- Start Featured Product -->
    <section class="bg-light">
      <div class="container py-5">
        <div class="row text-center py-3">
          <div class="col-lg-6 m-auto">
            <h1 class="h1">Produk Lainnya</h1>
            <p></p>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-4 mb-4">
            <div class="card h-100">
              <a href="shop-single.php">
                <img src="/assets/img/RPL/kaleng.jpg" class="card-img-top" alt="..." />
              </a>
              <div class="card-body">
                <ul class="list-unstyled d-flex justify-content-between">
                  <li>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                  </li>
                  <li class="text-muted text-right">Rp.Sekian</li>
                </ul>
                <a href="shop-single.php" class="h2 text-decoration-none text-dark">Kaleng</a>
                <p class="card-text">
                  Makanan kaleng praktis dan tahan lama, cocok untuk persediaan makanan di rumah atau saat bepergian. Nikmati berbagai pilihan, mulai dari ikan sarden, daging kornet, hingga buah kalengan yang siap saji dan lezat.
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4 mb-4">
            <div class="card h-100">
              <a href="shop-single.php">
                <img src="/assets/img/RPL/bengbeng.jpg" class="card-img-top" alt="..." />
              </a>
              <div class="card-body">
                <ul class="list-unstyled d-flex justify-content-between">
                  <li>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                  </li>
                  <li class="text-muted text-right">Rp.Sekian</li>
                </ul>
                <a href="shop-single.php" class="h2 text-decoration-none text-dark">Makanan Ringan</a>
                <p class="card-text">
                  Makanan ringan adalah pilihan sempurna untuk camilan di antara waktu, mulai dari keripik gurih hingga biskuit manis. Ideal untuk menemani istirahat atau kegiatan sehari-hari dengan variasi rasa yang menarik.
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4 mb-4">
            <div class="card h-100">
              <a href="shop-single.php">
                <img src="/assets/img/RPL/kacang.jpg" class="card-img-top" alt="..." />
              </a>
              <div class="card-body">
                <ul class="list-unstyled d-flex justify-content-between">
                  <li>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                  </li>
                  <li class="text-muted text-right">Rp.Sekian</li>
                </ul>
                <a href="shop-single.php" class="h2 text-decoration-none text-dark">Kacang-kacangan</a>
                <p class="card-text">
                  Kacang-kacangan merupakan sumber protein nabati yang kaya akan nutrisi, seperti kacang tanah dan kacang hijau, cocok untuk camilan sehat atau sebagai tambahan dalam masakan. Tersedia dalam berbagai varian dan siap untuk
                  memenuhi kebutuhan gizi sehari-hari Anda.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Featured Product -->

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 pt-5">
            <h2 class="h2 text-success border-bottom pb-3 border-light logo">Manjurlink</h2>
            <ul class="list-unstyled text-light footer-link-list">
              <li>
                <i class="fas fa-map-marker-alt fa-fw"></i>
                Jl. Timbul No.33 1, RT.1/RW.3, Cipedak, Kec. Jagakarsa, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12630
              </li>
              <li>
                <i class="fa fa-phone fa-fw"></i>
                <a class="text-decoration-none" href="tel:010-020-0340">021-78884580</a>
              </li>
              <li>
                <i class="fa fa-envelope fa-fw"></i>
                <a class="text-decoration-none" href="mailto:info@company.com">info@company.com</a>
              </li>
            </ul>
          </div>

          <div class="col-md-4 pt-5">
            <h2 class="h2 text-light border-bottom pb-3 border-light">Products</h2>
            <ul class="list-unstyled text-light footer-link-list">
              <li><a class="text-decoration-none" href="#">Tepung</a></li>
              <li><a class="text-decoration-none" href="#">Gula</a></li>
              <li><a class="text-decoration-none" href="#">Minyak</a></li>
              <li><a class="text-decoration-none" href="#">Telur</a></li>
              <li><a class="text-decoration-none" href="#">Air Mineral</a></li>
              <li><a class="text-decoration-none" href="#">Mie Instan</a></li>
              <li><a class="text-decoration-none" href="#">Bumbu</a></li>
            </ul>
          </div>

          <div class="col-md-4 pt-5">
            <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
            <ul class="list-unstyled text-light footer-link-list">
              <li><a class="text-decoration-none" href="#">Home</a></li>
              <li><a class="text-decoration-none" href="#">About Us</a></li>
              <li><a class="text-decoration-none" href="#">Shop Locations</a></li>
              <li><a class="text-decoration-none" href="#">FAQs</a></li>
              <li><a class="text-decoration-none" href="#">Contact</a></li>
            </ul>
          </div>
        </div>

        <div class="row text-light mb-4">
          <div class="col-12 mb-3">
            <div class="w-100 my-3 border-top border-light"></div>
          </div>
          <div class="col-auto me-auto">
            <ul class="list-inline text-left footer-icons">
              <li class="list-inline-item border border-light rounded-circle text-center">
                <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
              </li>
              <li class="list-inline-item border border-light rounded-circle text-center">
                <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
              </li>
              <li class="list-inline-item border border-light rounded-circle text-center">
                <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
              </li>
              <li class="list-inline-item border border-light rounded-circle text-center">
                <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
              </li>
            </ul>
          </div>
          <div class="col-auto">
            <label class="sr-only" for="subscribeEmail">Email address</label>
            <div class="input-group mb-2">
              <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Email address" />
              <div class="input-group-text btn-success text-light">Subscribe</div>
            </div>
          </div>
        </div>
      </div>

      <div class="w-100 bg-black py-3">
        <div class="container">
          <div class="row pt-2">
            <div class="col-12">
              <p class="text-left text-light">Copyright &copy; 2024 Manjur</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script>
      $(document).ready(function () {
        $("#loginButton").click(function () {
          $("#loginModal .modal-body").load("login.php", function () {
            $("#loginModal").modal({ show: true });
          });
        });
      });
    </script>

    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <!-- End Script -->
  </body>
</html>
