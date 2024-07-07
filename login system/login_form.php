<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if ($row['user_type'] == 'user') {
         $_SESSION['user_name'] = $row['name'];
         header('location:../index.php');
      } elseif ($row['user_type'] == 'admin') {
            $_SESSION['user_name'] = $row['name'];
            header('location:../shopping cart/admin.php');
      }
     
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

   <!-- Bootstrap CSS link -->
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

   <!-- Custom CSS file link -->
   <style>
      .form-container {
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
      }
      .form-container .card {
         width: 400px;
         max-width: 100%;
         padding: 20px;
      }
   </style>

</head>
<body>
   <div class="form-container">
      <div class="card">
         <div class="card-body">
            <h3 class="card-title text-center">Login</h3>
            <?php
            if(isset($error)){
               foreach($error as $error){
                  echo '<div class="alert alert-danger">'.$error.'</div>';
               };
            };
            ?>
            <form action="" method="post">
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
               </div>
               <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
               </div>
               <button type="submit" name="submit" class="btn btn-success btn-block">Login Sekarang</button>
               <p class="text-center mt-3">Tidak punya akun? <a href="register_form.php">Daftar</a></p>
            </form>
         </div>
      </div>
   </div>

   <!-- Bootstrap JS, Popper.js, and jQuery -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>