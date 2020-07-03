<?php
 SESSION_START();
  require_once('config.php');

  if(isset($_POST['contact'])){
    $fname = htmlentities($_POST['fname']);
    $lname = htmlentities($_POST['lname']);
    $email = htmlentities($_POST['email']);
    $mobile = htmlentities($_POST['mobile']);
    $message = htmlentities($_POST['message']);


    $sql = "INSERT INTO feedback (fname,lname, email, mobile,message)
              VALUES (:fname, :lname, :email, :mobile, :message)";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
        ':fname' => $_POST['fname'],
        ':lname' => $_POST['lname'],
        ':email' => $_POST['email'],
        ':mobile' => $_POST['mobile'],
        ':message' => $_POST['message']));
        echo "<script>
          var r = confirm('Sent! You will be contacted soon in your email!');
          if(r == true){
            window.location.href='index.php';
          }
          </script>";
  }
?>




<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device=device-width, initial-scale=1.0">
<title>Contact Us</title>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
<form action="contact.php" method="post">
<div class="container">
<h2>Contact Bookworms</h2>
<div class="row100">
 <div class="col">
<div class="inputBox">
 <input type="text" name="fname" required="required">
 <span class="text">First Name</span>
 <span class="line"></span>
 </div>
 </div>
 <div class="col">
 <div class="inputBox">
 <input type="text" name="lname" required="required">
 <span class="text">Last Name</span>
 <span class="line"></span>
 </div>
 </div>
 </div>
 <div class="row100">
 <div class="col">
 <div class="inputBox">
 <input type="email" name="email" required="required">
 <span class="text">Email</span>
 <span class="line"></span>
 </div>
 </div>
 <div class="col">
 <div class="inputBox">
 <input type="text" name="mobile" required="required">
 <span class="text">Mobile</span>
 <span class="line"></span>
 </div>
 </div>
 </div>
 <div class="row100">
 <div class="col">
<div class="inputBox">
 <textarea id="Message" name="message"  required="required"></textarea>
 <span class="text">Type your message here...</span>

 </div>
 </div>
</div>
 <div class="row100">
 <div class="col">
 <input type="submit" value="Send" name="contact">
 </div>
 </div>
 </div>
 </form>
 <div class="footer">
  <p>© All Rights Reserved by NSU-BOOKWorms</p>
</div>

 </body>
 </html>
