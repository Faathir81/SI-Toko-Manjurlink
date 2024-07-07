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
    <title>Manjurlink - Product Listing Page</title>
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
    <?php

    if(isset($message)){
      foreach($message as $message){
          echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
      };
    };

    ?>

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

    <!-- Start Content -->
    <div class="container py-5">
      <div class="row">
        <div class="col-lg-3">
          <h1 class="h2 pb-4">Categories</h1>
          <ul class="list-unstyled templatemo-accordion">
            <li class="pb-3">
              <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                Minuman
                <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
              </a>
              <ul class="collapse show list-unstyled pl-3">
                <li><a class="text-decoration-none" href="#">Air Mineral</a></li>
                <li><a class="text-decoration-none" href="#">Susu</a></li>
              </ul>
            </li>
            <li class="pb-3">
              <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                Sale
                <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
              </a>
              <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                <li><a class="text-decoration-none" href="#">This Week</a></li>
                <li><a class="text-decoration-none" href="#">This Month</a></li>
              </ul>
            </li>
            <li class="pb-3">
              <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                Product
                <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
              </a>
              <ul id="collapseThree" class="collapse list-unstyled pl-3">
                <li><a class="text-decoration-none" href="#">Bumbu dan Rempah</a></li>
                <li><a class="text-decoration-none" href="#">Bahan Pokok</a></li>
                <li><a class="text-decoration-none" href="#">Snack dan Camilan</a></li>
              </ul>
            </li>
          </ul>
        </div>

        <div class="col-lg-9">
          <div class="row">
            <div class="col-md-6">
              <ul class="list-inline shop-top-menu pb-3 pt-1">
                <li class="list-inline-item">
                  <a class="h3 text-dark text-decoration-none mr-3" href="#">All</a>
                </li>
                <li class="list-inline-item">
                  <a class="h3 text-dark text-decoration-none mr-3" href="#">Bumbu dan Rempah</a>
                </li>
                <li class="list-inline-item">
                  <a class="h3 text-dark text-decoration-none" href="#">Bahan Pokok</a>
                </li>
              </ul>
            </div>
            <div class="col-md-6 pb-4">
              <div class="d-flex">
                <select class="form-control">
                  <option>Featured</option>
                  <option>A to Z</option>
                  <option>Item</option>
                </select>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <?php
              $select_products = mysqli_query($conn, "SELECT * FROM `products`");
              if(mysqli_num_rows($select_products) > 0){
                  while($fetch_product = mysqli_fetch_assoc($select_products)){
              ?>
                  <div class="col-md-4 mb-4">
                      <div class="card">
                          <img src="/shopping cart/uploaded_img/<?php echo htmlspecialchars($fetch_product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($fetch_product['name']); ?>">
                          <div class="card-body">
                              <h5 class="card-title"><?php echo htmlspecialchars($fetch_product['name']); ?></h5>
                              <p class="card-text">Rp.<?php echo $fetch_product['price']; ?>/-</p>
                              <form action="" method="post">
                                  <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_product['name']); ?>">
                                  <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                  <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_product['image']); ?>">
                                  <button type="submit" class="btn btn-primary" name="add_to_cart">Add to Cart</button>
                              </form>
                          </div>
                      </div>
                  </div>
              <?php
                  }
              } else {
                  echo '<div class="col-12"><p>No products found.</p></div>';
              }
              ?>
            </div>
          </div>
          <div div="row">
            <ul class="pagination pagination-lg justify-content-end">
              <li class="page-item disabled">
                <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="#" tabindex="-1">1</a>
              </li>
              <li class="page-item">
                <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark" href="#">3</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- End Content -->

    <!-- Start Brands -->
<section class="bg-light py-5">
      <div class="container my-4">
        <div class="row text-center py-3">
          <div class="col-lg-6 m-auto">
            <h1 class="h1">Our Brands</h1>
            <p>Kami menyediakan berbagai produk dari merek-merek terpercaya. Produk kami terjamin berkualitas tinggi dan terjangkau.</p>
          </div>
          <div class="col-lg-9 m-auto tempaltemo-carousel">
            <div class="row d-flex flex-row">
              <!--Controls-->
              <div class="col-1 align-self-center">
                <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="prev">
                  <i class="text-light fas fa-chevron-left"></i>
                </a>
              </div>
              <!--End Controls-->

              <!--Carousel Wrapper-->
              <div class="col">
                <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="templatemo-slide-brand" data-bs-ride="carousel">
                  <!--Slides-->
                  <div class="carousel-inner product-links-wap" role="listbox">
                    <!--First slide-->
                    <div class="carousel-item active">
                      <div class="row">
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/nestle.png" alt="Brand Logo" /></a>
                        </div>
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/OT.webp" alt="Brand Logo" /></a>
                        </div>
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/danone.png" alt="Brand Logo" /></a>
                        </div>
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/indofood.png" alt="Brand Logo" /></a>
                        </div>
                      </div>
                    </div>
                    <!--End First slide-->

                    <!--Second slide-->
                    <div class="carousel-item">
                      <div class="row">
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/nestle.png" alt="Brand Logo" /></a>
                        </div>
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/OT.webp" alt="Brand Logo" /></a>
                        </div>
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/danone.png" alt="Brand Logo" /></a>
                        </div>
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/indofood.png" alt="Brand Logo" /></a>
                        </div>
                      </div>
                    </div>
                    <!--End Second slide-->

                    <!--Third slide-->
                    <div class="carousel-item">
                      <div class="row">
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/nestle.png" alt="Brand Logo" /></a>
                        </div>
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/OT.webp" alt="Brand Logo" /></a>
                        </div>
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/danone.png" alt="Brand Logo" /></a>
                        </div>
                        <div class="col-3 p-md-5">
                          <a href="#"><img class="img-fluid brand-img" src="assets/img/RPL/indofood.png" alt="Brand Logo" /></a>
                        </div>
                      </div>
                    </div>
                    <!--End Third slide-->
                  </div>
                  <!--End Slides-->
                </div>
              </div>
              <!--End Carousel Wrapper-->

              <!--Controls-->
              <div class="col-1 align-self-center">
                <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="next">
                  <i class="text-light fas fa-chevron-right"></i>
                </a>
              </div>
              <!--End Controls-->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--End Brands-->

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
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
  </body>
</html>
