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
    <title>Manjurlink - Contact</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico" />

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/templatemo.css" />
    <link rel="stylesheet" href="assets/css/custom.css" />
    <link href="locatorplus.css" rel="stylesheet" />

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="assets/css/fontawesome.min.css" />

    <!-- Load map styles -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
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

    <!-- Start Content Page -->
    <div class="container-fluid bg-light py-5">
      <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Contact Us</h1>
        <p>
          Memiliki kendala dalam pemesanan? Hubungi kami!
        </p>
      </div>
    </div>

    <!-- Start Map -->
    <div id="mapid" style="width: 100%; height: 300px"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script>
      var mymap = L.map("mapid").setView([-23.013104, -43.394365, 13], 13);

      L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw", {
        maxZoom: 18,
        id: "mapbox/streets-v11",
        tileSize: 512,
        zoomOffset: -1,
      }).addTo(mymap);

      L.marker([-23.013104, -43.394365, 13]).addTo(mymap).bindPopup("<b>Toko Manjur</b> > Lokasi.").openPopup();

      mymap.scrollWheelZoom.disable();
      mymap.touchZoom.disable();
    </script>
    <!-- End Map -->

    <!-- Start Contact -->
    <div class="container py-5">
      <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">
          <div class="row">
            <div class="form-group col-md-6 mb-3">
              <label for="inputname">Name</label>
              <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Name" />
            </div>
            <div class="form-group col-md-6 mb-3">
              <label for="inputemail">Email</label>
              <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email" />
            </div>
          </div>
          <div class="mb-3">
            <label for="inputsubject">Subject</label>
            <input type="text" class="form-control mt-1" id="subject" name="subject" placeholder="Subject" />
          </div>
          <div class="mb-3">
            <label for="inputmessage">Message</label>
            <textarea class="form-control mt-1" id="message" name="message" placeholder="Message" rows="8"></textarea>
          </div>
          <div class="row">
            <div class="col text-end mt-2">
              <button type="submit" class="btn btn-success btn-lg px-3">Let’s Talk</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- End Contact -->

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
    <script type="module" src="https://unpkg.com/@googlemaps/extended-component-library@0.6"></script>
    <gmpx-api-loader key="YOUR_API_KEY_HERE" solution-channel="GMP_QB_locatorplus_v10_cABDF"></gmpx-api-loader>
    <gmpx-store-locator map-id="DEMO_MAP_ID"></gmpx-store-locator>
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
  </body>
</html>
