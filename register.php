   <?php
      include("conn/connection.php");

      if($_SERVER['REQUEST_METHOD'] == "POST"){
          $username = $_POST['username'];
          $password = $_POST['password'];
          $confirmPassword = $_POST['confirmPassword'];

          if($password == $confirmPassword){


            $checkforexitingaccount = "SELECT * FROM users";
            $checkforesult = mysqli_query($conn,$checkforexitingaccount);

            $checkValue = 0;

            while($check = mysqli_fetch_assoc($checkforesult)){
                

              if($check['username'] == $username){

                $checkValue = 1;

                

              }
              
            }

            if($checkValue == 0){

              $defaultProfile = "../profile_pictures/default.jpg";
              $sql = "INSERT INTO users (username,password,profile) VALUES ('$username','$password','$defaultProfile')";
              mysqli_query($conn,$sql);

                header("Location: index.php");              
            }else{
              echo"
              <script> alert('Username is already taken!');</script>
               ";
            }

              

          
              

          }else{
            echo"
                <script> alert('Password Dont Match!');</script>
            ";
          }
      }
   ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Sign up</title>
      <link rel="stylesheet" href="register.css">
    </head>
    <body>
    <div class="container">
    <div class="registration form">
          <header>Signup</header>
          <form action="register.php" method = "post">
            <input type="text" placeholder="Enter your username" name = "username">
            <input type="password" placeholder="Create a password" name = "password">
            <input type="password" placeholder="Confirm your password" name = "confirmPassword">
            <input type="submit" class="button" value="Signup">
          </form>
          <div class="signup">
            <span class="signup">Already have an account?
        <a href="index.php">Signup</a>
            </span>
          </div>
        </div>
    </div>
    </body>
    </html>