<?php

@include 'config.php';

if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $country = $_POST['country'];
   $password = $_POST['password'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   $total_quantity = 0; // Inisialisasi total quantity

   $product_name = []; // Inisialisasi array untuk menyimpan nama produk

   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';

         // Periksa jika price dan quantity adalah numerik sebelum melakukan perhitungan
         $product_price = floatval($product_item['price']) * intval($product_item['quantity']); // Menggunakan floatval dan intval untuk memastikan nilai numerik

         $price_total += $product_price;
         $total_quantity += intval($product_item['quantity']); // Tambahkan quantity produk ke total_quantity
      }
   }

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `orders`(name, number, email, method, flat, street, city, country, password, quantity, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$country','$password','$total_quantity','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$country." - ".$password."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
            <p>(*pay when product arrives*)</p>
         </div>
            <a href='../shop.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }
   
   if(isset($_POST['submit'])){

      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $pass = md5($_POST['password']);
      $cpass = md5($_POST['cpassword']);
      $user_type = $_POST['user_type'];
   
      $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
   
      $result = mysqli_query($conn, $select);
   
      if(mysqli_num_rows($result) > 0){
   
         $row = mysqli_fetch_array($result);
   
         if($row['user_type'] == 'admin'){
   
            $_SESSION['admin_name'] = $row['name'];
            header('location:../shopping%20cart/admin.php');
   
         }elseif($row['user_type'] == 'user'){
   
            $_SESSION['user_name'] = $row['name'];
            header('location:../index.php');
   
         }
        
      }else{
         $error[] = 'incorrect email or password!';
      }
   
   };
   

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .inputBox {
         margin-bottom: 10px;
      }
      
      .inputBox input[readonly] {
         pointer-events: none; /* Membuat input tidak bisa diklik */
         background-color: #f0f0f0; /* Memberikan warna latar belakang abu-abu */
      }
   </style>

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<div class="alert alert-danger">'.$error.'</div>';
         };
      };
   ?>

   <form action="" method="post">

      <div class="display-order">
         <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                  $total_price = $fetch_cart['price'] * $fetch_cart['quantity']; // Hitung total tanpa number_format()
                  $grand_total += $total_price;
         ?>
                  <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
         <?php
            }
         } else {
            echo "<div class='display-order'><span>your cart is empty!</span></div>";
         }
         ?>
         <span class="grand-total"> grand total : Rp.<?= number_format($grand_total); ?>/- </span> <!-- Format grand_total saat menampilkan -->
      </div>


      <div class="flex">
         <div class="inputBox">
            <span>Your Name</span>
            <input type="text" placeholder="Enter your name" name="name" value="<?php echo htmlspecialchars($user_name); ?>" readonly>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>Your Email</span>
            <input type="email" placeholder="Enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="cash on delivery" selected>cash on delivery</option>
               <option value="credit cart">credit card</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="e.g. flat no." name="flat" required>
         </div>
         <div class="inputBox">
            <span>address line 2</span>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="e.g. Jakarta" name="city" required>
         </div>
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="e.g. Indonesia" name="country" required>
         </div>
         <div class="inputBox">
            <span>password</span>
            <input type="password" name="password" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>