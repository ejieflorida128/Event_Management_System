<?php
include("conn/connection.php");
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);

    $check = 0;
    while($test = mysqli_fetch_assoc($result)){

        if($username == "admin"){
          if($password == "admin"){
            $check = 2;
          }
        }
        if($test['username'] == $username){
          if($test['password'] == $password){
              $check = 1;

              $_SESSION['username'] = $test['username'];
              $_SESSION['id'] = $test['id'];  
            
              
          }
        }
    }

    if($check == 0){
      echo "
               <script>alert('Account Didn\'t Exist or Not found in the Database!');</script>
        ";

    }else if($check == 1){
      header("Location: user/User_Dashboard.php");
    }else if($check == 2){
      header("Location: admin/Admin_Dashboard.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form</title>
 
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="index.php" method = "post">
        <input type="text" placeholder="Enter your username" name = "username">
        <input type="password" placeholder="Enter your password" name = "password">
       
        <input type="submit" class="button" value="Login">
      </form>
      <div class="signup">
        <span class="signup">Don't have an account?
         <a href="register.php">Signup</a>
        </span>
      </div>
    </div>
  
  </div>
</body>
</html>