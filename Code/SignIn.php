<!--Done by Shahad Alfaddagh-->
<?php 
if(isset($_POST['submit'])){

  include("includes/db-con.php");

  //Set the username and password variables
  $username = $_POST['EID'];
  $password = $_POST['password'];

    //Sql query to get the admin ID from the database and save the result in a new variable
    $sql = "SELECT * FROM admin WHERE AdID= '". $username."';";
      $result = mysqli_query($conn, $sql);
      //compare the password to authinticate the admin
      if($row = mysqli_fetch_assoc($result)){
        if($password == $row['AdPassword']){
                
          header("Location: admin-home.php");
          exit();
        }
        //reeor message for wrong password
        else{
          header("Location: SignIn.php?problem=errorlogin");
          exit();
        }
      }
      //reeor message for wrong ID 
      else{
        header("Location: SignIn.php?problem=nouser");
        exit();
      }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="SignInStyle.css">
  <!-- linking javascript page -->
  <script src="jsSignIn.js"></script>
  <title>Sign In</title>
</head>
<body>
  <img src="img/logo.png" alt="Logo">
    <div class="page">
      <div class="container">
        <div class="left">
          <div class="icon"><img src="img/icons8-user-64.png">
          <div class="login">Login</div></div>
          <!--in this link it will go to the home page-->
          <div class="eula">Log in is available for the admins only, If you are not an admin you can <a href="index.php">continue as a guest</a></div>
        </div>
        <div class="right">
          <!--This is for the line in javascript-->
          <svg viewBox="0 0 320 300">
            <defs>
              <linearGradient
                inkscape:collect="always"
                id="linearGradient"
                x1="13"
                y1="193.49992"
                x2="307"
                y2="193.49992"
                gradientUnits="userSpaceOnUse">
                <stop
                  style="stop-color:#587c6e;"
                  offset="0"
                  id="stop876" />
                <stop
                  style="stop-color:#7cb99a;"
                  offset="1"
                  id="stop878" />
              </linearGradient>
            </defs>
            <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
          </svg>
          <!--Sign in form-->
          <div class="form">
            <form action="SignIn.php" method= "post" id="form">
            <label>Admin ID</label>
            <input type="text" id="EID" name="EID" >
            <label>Password</label>
            <input type="password" id="password" name="password" >
            <input type="submit" id="submit" name="submit" value="Submit">
          </form>
          <?php 
          //setting each error with it's messege
            if(isset($_GET['problem'])){
            
            if($_GET['problem'] == "errorlogin"){
                echo '<p><br><b>Invalid ID and/or Password. Please try again.</b></p>';
            }
            if($_GET['problem'] == "nouser"){
              echo '<p><br><b>The ID inserted does not exist.</b></p>';
          }
            }        
          ?>
          <!-- Class for the javascript validation errors -->
          <div id="helpText"></div>
          </div>
        </div>
      </div>
    </div>
    <!--linking the javascript page-->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js'></script>
    <script src="jsSignIn.js"></script>
  </body>
</html>