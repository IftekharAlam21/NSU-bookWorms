<?php
  session_start();
  require "config.php";
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ADMIN | Book list</title>
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
    <h2>List of all Books</h2>
    <?php
    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red; background-color:white; margin:5px; padding:5px ">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }
    if ( isset($_SESSION['success']) ) {
        echo '<p style="color:green; background-color:white; margin:5px; padding:5px ">'.$_SESSION['success']."</p>\n";
        unset($_SESSION['success']);
    }

     ?>

    <?php
    if (isset($_SESSION['user'])) {
      $stmt1 = $db->query("SELECT * FROM books");
      $row2 = $stmt1->fetch(PDO::FETCH_ASSOC) ;

      if ($row2 > 0) {
        echo('<table>'."\n");
        echo "<tr><th>";
        echo "ID";
        echo "</th><th>";
        echo "Title";
        echo "</th><th>";
        echo "Author";
        echo "</th><th>";
        echo "Type";
        echo "</th><th>";
        echo "Edition";
        echo "</th><th>";
        echo "Genre";
        echo "</th><th>";
        echo "Status";
        echo "</th><th>";
        echo "Price";
        echo "</th><th>";
        echo "Comments";
        echo "</th><th>";
        echo "Owner";
        echo "</th><th>";
        echo "Lend";
        echo "</th><th>";
        echo "Action";
        echo "</th></tr>";

        $stmt = $db->query("SELECT bid, title ,author,type,edition,genre,status,price,comments,owner,lend FROM books");
        while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
            echo "<tr><td>";
            echo(htmlentities($row['bid']));
            echo("</td><td>");
            echo(htmlentities($row['title']));
            echo("</td><td>");
            echo(htmlentities($row['author']));
            echo("</td><td>");
            echo(htmlentities($row['type']));
            echo("</td><td>");
            echo(htmlentities($row['edition']));
            echo("</td><td>");
            echo(htmlentities($row['genre']));
            echo("</td><td>");
            echo(htmlentities($row['status']));
            echo("</td><td>");
            echo(htmlentities($row['price']));
            echo("</td><td>");
            echo(htmlentities($row['comments']));
            echo("</td><td>");
            echo(htmlentities($row['owner']));
            echo("</td><td>");
            echo(htmlentities($row['lend']));
            echo("</td><td>");
            echo('<a href="editbooks.php?bid='.$row['bid'].'">Edit</a>');
            echo('<a href="deletebooks.php?bid='.$row['bid'].'">Delete</a>');
            echo("</td></tr>\n");
        }
        echo("</table>");

      }else {
        echo "No rows found".'</br>';
      }
      echo '</br>'."<a href='addbooks.php'>Add New Book</a>";

    }
    else {
      echo "<a href='login.php'>Please log in</a></br>";
    }
     ?>

   </div>

  </body>
</html>
