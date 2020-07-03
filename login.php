<?php
  SESSION_START();

 if (isset($_POST['login'])) {

  require 'dbhinc.php';

  $user = $_POST['user'];
  $pass = $_POST['pass'];

  $query = "SELECT * FROM users WHERE email='$user' and password='$pass' ";
  $result= mysqli_query($conn,$query);
  if(mysqli_num_rows($result)==1)
  {
      $row= mysqli_fetch_assoc($result);
      $_SESSION['user']= $row['email'];
     $_SESSION['name']= $row['name'];
     $_SESSION['id']= $row['id'];
    $_SESSION['number']= $row['c_number'];

    if ( $_SESSION['id']==1) {
      header('Location:admin.php');
    }
    else {
      header('Location:index.php');
    }

  }
  else{
    $_SESSION['error'] = 'Not successful';
    header("Location: login.php");
    return;
  }


 }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>
    <?php
    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }
    ?>

    <div class="login_page">

      <div class="login_msg">
        <h2> <b>Welcome <span class="blink"> Book Worm! </span>  Enter Please log in here.</b></h2>

      </div>
      <div class="container2">
      <form action="login.php" method="post" class="loginn">
        <div class="form_login">

          <label for="user"><b>Email</b></label> <br>
          <input type="text" name="user" required> <br>

          <label for="pass"><b>Password</b></label> <br>
          <input type="password" name="pass" required> <br>
       </div>

       <div class="clearfix">
         <button type="submit" class="login" name="login" value="login">login</button>

       </div>




      </form>
      <div class="login_msg1">
        <p>Don't have an account? <a href="signup.php" style="color:white"> <span class="blink"> Sign Up </span></a></p>

      </div>
      </div>
    </div>
  </body>
