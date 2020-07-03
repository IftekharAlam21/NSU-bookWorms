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
      $stmt1 = $db->query("SELECT * FROM feedback");
      $row2 = $stmt1->fetch(PDO::FETCH_ASSOC) ;

      if ($row2 > 0) {
        echo('<table>'."\n");
        echo "<tr><th>";
        echo "Name";
        echo "</th><th>";
        echo "Email";
        echo "</th><th>";
        echo "Number";
        echo "</th><th>";
        echo "Message";
        echo "</th><th>";
        echo "Status";
        echo "</th></tr>";

        $stmt = $db->query("SELECT id, fname,lname,email,mobile,message,status FROM feedback");
        while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
            echo "<tr><td>";
            echo(htmlentities($row['fname'] ));
            echo " ";
            echo(htmlentities( $row['lname']));
            echo("</td><td>");
            echo(htmlentities($row['email']));
            echo("</td><td>");
            echo(htmlentities($row['mobile']));
            echo("</td><td>");
            echo(htmlentities($row['message']));
            echo("</td><td>");
            echo "<label class='switch'><input type='checkbox'><span class='slider round'></span></label>";
              echo('<a href="deletemessage.php?id='.$row['id'].'">DELETE</a>');
            echo("</td></tr>\n");
        }
        echo("</table>");

      }else {
        echo "<p style = 'background-color: white; width:50%;  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
 margin:50px; padding:5px;'>No New Messages</p>";
      }
    }
    else {
      echo "<a href='login.php'>Please log in</a></br>";
    }
     ?>

   </div>

  </body>
</html>
