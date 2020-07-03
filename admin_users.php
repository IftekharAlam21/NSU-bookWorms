<?php
  session_start();
  require "config.php";
 ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ADMIN | List</title>
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
    <h2>List of all users</h2>
    <?php
    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red ; background-color:white; margin:5px; padding:5px ">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }
    if ( isset($_SESSION['success']) ) {
        echo '<p style="color:green; background-color:white; margin:5px; padding:5px ">'.$_SESSION['success']."</p>\n";
        unset($_SESSION['success']);
    }

     ?>

    <?php
    if (isset($_SESSION['user'])) {
      $stmt1 = $db->query("SELECT * FROM users");
      $row2 = $stmt1->fetch(PDO::FETCH_ASSOC) ;

      if ($row2 > 0) {
        echo('<table>'."\n");
        echo "<tr><th>";
        echo "ID";
        echo "</th><th>";
        echo "Name";
        echo "</th><th>";
        echo "Email";
        echo "</th><th>";
        echo "NSU ID";
        echo "</th><th>";
        echo "Address";
        echo "</th><th>";
        echo "Contact";
        echo "</th><th>";
        echo "Gender";
        echo "</th><th>";
        echo "Action";
        echo "</th></tr>";

        $stmt = $db->query("SELECT id, name,email,nsu_id,address,c_number,gender FROM users where id > 1");
        while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
            echo "<tr><td>";
            echo(htmlentities($row['id']));
            echo("</td><td>");
            echo(htmlentities($row['name']));
            echo("</td><td>");
            echo(htmlentities($row['email']));
            echo("</td><td>");
            echo(htmlentities($row['nsu_id']));
            echo("</td><td>");
            echo(htmlentities($row['address']));
            echo("</td><td>");
            echo(htmlentities($row['c_number']));
            echo("</td><td>");
            echo(htmlentities($row['gender']));
            echo("</td><td>");
            echo('<a href="edituser.php?id='.$row['id'].'">Edit</a> / ');
            echo('<a href="deleteusers.php?id='.$row['id'].'">Delete</a>');
            echo("</td></tr>\n");
        }
        echo("</table>");

      }else {
        echo "No rows found".'</br>';
      }
      echo '</br>'."<a href='signup.php'>Add New User</a></br></br>";

    }
    else {
      echo "<a href='login.php'>Please log in</a></br>";
    }
     ?>

   </div>

  </body>
</html>
