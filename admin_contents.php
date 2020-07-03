<?php
  SESSION_START();
  if ( ! isset($_SESSION['user']) ) {
    die('Not logged in');
  }
 ?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  body {
    font-family: "Lato", sans-serif;
    background-image: url('img/a6.jpg');
    background-size:cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 90vh;
    position: relative;
    margin: 0px;
    padding: 0px;
  }

  .sidenav {
    height: 100%;
    width: 200px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    padding-top: 20px;
  }

  .sidenav a {
    padding: 6px 6px 6px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
  }

  .sidenav a:hover {
    color: #f1f1f1;
  }

  .main {
    margin-left: 200px; /* Same as the width of the sidenav */
  }


  h2{
    text-align: center;
    background-color: green;
    border-radius: 50px;
    margin : 15px;
    padding: 15px;
    color: white;
  }


  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
  }
  </style>
</head>
<body>

<div class="sidenav">
  <p style="color:white; text-align:center; font-size:30px" >Options</p>  <hr> </br>
  <a href="index.php">Home</a></br>
  <a href="admin_users.php">List of people</a></br>
  <a href="admin_books.php">List of books</a></br>
  <a href="admin_messages.php">Messages</a></br>
  <a href="userfeedback.php">Feedback from users</a></br>
  <a href="logout.php">Log out</a>
</div>

<div class="main">
 <h2>Manage the Website</h2>

 </div>

</body>
</html>
