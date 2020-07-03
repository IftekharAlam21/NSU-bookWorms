<?php

  session_start();
  require_once('config.php');
  if(isset($_POST['signup'])){
    if ( strpos($_POST['email'],'@northsouth.edu') == true) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $nsuid = $_POST['nsuid'];
    $address = $_POST['address'];
    $number = $_POST['cnum'];
    $gender = $_POST['gender'];



  $sql = "INSERT INTO users (name,email,password,nsu_id,address,c_number,gender) VALUES(?,?,?,?,?,?,?)";
  $stmtinsert = $db->prepare($sql);
  $result = $stmtinsert->execute([$name,$email,$password,$nsuid,$address,$number,$gender]);
  if ($result){
    echo "<script>
      var r = confirm('Awesome! Thanks for Joining');
      if(r == true){
        window.location.href='index.php';
      }
      </script>";
    }

  else {
    $_SESSION['error'] = 'Not successful';
    header("Location: signup.php");
    return;
    }
  }
  else {
    $_SESSION['error'] = 'Only NSUers Allowed';
    header("Location: signup.php");
    return;
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <?php
    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }
    ?>

    <div class="des">
     <form action="signup.php" method="post">
       <div class="container1">
         <h1><b><span class="blink">Sign Up</span></b></h1>
         <p><font color="white">Please fill in this form to create an account.</font> </p>
         <hr>
         <div class="info">

         <label for="name"><b>Name</b></label> <br>
         <input type="text" placeholder="Enter Your name" name="name" required> <br>

         <label for="email"><b>Email</b></label> <br>
         <input type="email" placeholder="Enter Email" name="email" required> <br>

         <label for="psw"><b>Password</b></label> <br>
         <input type="password" placeholder="Enter Password" name="psw" required> <br>

         <label for="nsuid"><b>NSU ID</b></label> <br>
         <input type="text" placeholder="Enter Your student ID" name="nsuid" required> <br>

         <label for="address"><b>Address</b></label> <br>
         <input type="text" placeholder="Enter Address" name="address" required> <br>

         <label for="cnum"><b>Contact number</b></label> <br>
         <input type="text" placeholder="Enter contact number" name="cnum" required> <br>

         <b>Gender:</b> <br>
         <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
         <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male

        </div>
         <hr>
         <p style="color:black">By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

         <div class="clearfix">
           <button type="button" class="cancel"> <a href="index.php" >Cancel</a> </button>
           <button type="submit" class="register" name="signup" value="sign up">Sign Up</button>
         </div>

         <p>Already have an account? <a href="login.php">Sign in</a></p>
       </div>


     </form>
    </div>

  </body>
</html>
