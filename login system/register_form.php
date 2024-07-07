<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

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
         <h3 class="card-title text-center">Register Now</h3>
         <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<div class="alert alert-danger">'.$error.'</div>';
            };
         };
         ?>
         <form action="" method="post">
            <div class="form-group">
               <label for="name">Name</label>
               <input type="text" name="name" id="name" class="form-control" required placeholder="Enter your name">
            </div>
            <div class="form-group">
               <label for="email">Email</label>
               <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
            </div>
            <div class="form-group">
               <label for="password">Password</label>
               <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
            </div>
            <div class="form-group">
               <label for="cpassword">Confirm Password</label>
               <input type="password" name="cpassword" id="cpassword" class="form-control" required placeholder="Confirm your password">
            </div>
            <div class="form-group">
               <label for="user_type">User Type</label>
               <select name="user_type" id="user_type" class="form-control">
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
               </select>
            </div>
            <button type="submit" name="submit" class="btn btn-success btn-block">Register Now</button>
            <p class="text-center mt-3">Already have an account? <a href="login_form.php">Login Now</a></p>
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
