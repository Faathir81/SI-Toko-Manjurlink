<?php
@include 'shopping cart/config.php';
session_start();

if(!isset($_SESSION['user_name'])){
   header('location: ../login%20system/login_form.php');
   exit(); // Pastikan untuk keluar dari skrip setelah me-redirect
}

$user_name = $_SESSION['user_name'];
?>

<header class="header">

   <div class="flex">

      <a href="#" class="logo">Manjurlink</a>

      <nav class="navbar">
         <a href="#" class="user-name"><?php echo htmlspecialchars($user_name); ?></a>
         <a href="../shop.php">view products</a>
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>