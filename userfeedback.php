<?php
  session_start();
  require "config.php";
 ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ADMIN | Inbox</title>
    <link rel="stylesheet" type="text/css" href="adminstyle.css">

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
    <h2>Messages</h2>
    <p style = 'background-color: white; width:50%;  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
margin:50px; padding:5px;'>No New Messages</p>
  </body>
</html>
